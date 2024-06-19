<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Subject;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Timetable')]
class Schedules extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $search = true;

    public $schedule = false;

    public $classroom;

    public ?array $searchData = [];

    public ?array $createData = [];

    public function mount()
    {
        $this->searchEntries->fill();
        $this->createSchedule->fill();
    }

    protected function getForms(): array
    {
        return [
            'searchEntries',
            'createSchedule',
        ];
    }

    protected function onValidationError(): void
    {
        Notification::make()
            ->title('Error')
            ->body('Please select all inputs')
            ->danger()
            ->send();
    }

    public function searchEntries(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['sm' => 2, 'md' => 3])
                    ->schema([
                        Select::make('exam')
                            ->options(Exam::all()->pluck('name', 'id'))
                            ->searchable()
                            ->live(true)
                            ->native(false)
                            ->required(),
                        Select::make('grade')
                            ->options(Grade::all()->pluck('name', 'id'))
                            ->searchable()
                            ->live(true)
                            ->native(false)
                            ->required()
                            ->afterStateUpdated(fn (Set $set) => $set('classroom', null)),
                        Select::make('classroom')
                            ->options(fn (Get $get) => Classroom::query()
                                ->where('grade_id', $get('grade'))
                                ->get(['id', 'name'])
                                ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->live(true)
                            ->native(false)
                            ->required(),
                    ]),
            ])
            ->statePath('searchData');
    }

    public function createSchedule(Form $form): Form
    {
        return $form
            ->model(Classroom::class)
            ->schema([$this->subjectGrid()])
            ->statePath('createData');
    }

    public function subjectGrid(): Grid
    {
        return Grid::make(3)
            ->schema(function (string $model) {
                if ($this->classroom) {
                    return $model::query()->find($this->classroom)->subjects->map(function (Subject $subject) {
                        return Section::make(new HtmlString("<p class='capitalize'>$subject->name</p><p class='font-medium'>($subject->type)</p>"))
                            ->description('Click to toggle collapse.')
                            ->icon('s-calendar-days')
                            ->schema([
                                TextInput::make($subject->id.'.full_mark')
                                    ->numeric()
                                    ->minValue(10)
                                    ->maxValue(100)
                                    ->placeholder(100),
                                TextInput::make($subject->id.'.pass_mark')
                                    ->numeric()
                                    ->minValue(10)
                                    ->maxValue(100)
                                    ->placeholder(50),
                                DatePicker::make($subject->id.'.date')
                                    ->placeholder('Click to insert')
                                    ->native(false)
                                    ->closeOnDateSelection(),
                                TimePicker::make($subject->id.'.start_time')
                                    ->placeholder('Click to insert')
                                    ->seconds(false)
                                    ->displayFormat('g:i A')
                                    ->datalist([
                                        '08:00',
                                        '08:30',
                                        '09:00',
                                        '09:30',
                                        '10:00',
                                        '10:30',
                                        '11:00',
                                        '11:30',
                                        '12:00',
                                        '12:30',
                                        '13:00',
                                        '13:30',
                                        '14:00',
                                        '14:30',
                                        '15:00',
                                        '15:30',
                                        '16:00',
                                        '16:30',
                                        '17:00',
                                    ])
                                    ->native(false),
                                TimePicker::make($subject->id.'.end_time')
                                    ->placeholder('Click to insert')
                                    ->seconds(false)
                                    ->displayFormat('g:i A')
                                    ->datalist([
                                        '08:00',
                                        '08:30',
                                        '09:00',
                                        '09:30',
                                        '10:00',
                                        '10:30',
                                        '11:00',
                                        '11:30',
                                        '12:00',
                                        '12:30',
                                        '13:00',
                                        '13:30',
                                        '14:00',
                                        '14:30',
                                        '15:00',
                                        '15:30',
                                        '16:00',
                                        '16:30',
                                        '17:00',
                                    ])
                                    ->native(false),
                            ])
                            ->columnSpan(1)
                            ->collapsed();
                    })
                        ->all();
                } else {
                    return [];
                }
            });
    }

    public function generate(): void
    {
        $data = $this->searchEntries->getState();
        $this->classroom = $data['classroom'];
        $entries = Schedule::query()
            ->where('exam_id', $data['exam'])
            ->where('classroom_id', $data['classroom'])
            ->get()
            ->keyBy('subject_id')
            ->toArray();

        $formState = [];
        foreach ($entries as $subject_id => $entry) {
            $formState[$subject_id] = [
                'full_mark' => $entry['full_mark'],
                'pass_mark' => $entry['pass_mark'],
                'date' => $entry['date'],
                'start_time' => $entry['start_time'],
                'end_time' => $entry['end_time'],
            ];
        }

        $this->createSchedule->fill($formState);
        $this->search = ! $this->search;
        $this->schedule = ! $this->schedule;
    }

    public function create(): void
    {
        $data = collect($this->searchEntries->getState())
            ->put('schedule', $this->createSchedule->getState());

        DB::transaction(function () use ($data) {
            collect($data['schedule'])->each(function ($datum, $index) use ($data) {
                if ($datum['date'] && $datum['start_time'] && $datum['end_time'] && $datum['full_mark'] && $datum['pass_mark']) {
                    Schedule::query()->updateOrCreate(
                        [
                            'exam_id' => $data['exam'],
                            'classroom_id' => $data['classroom'],
                            'subject_id' => $index,
                        ],
                        [
                            'date' => $datum['date'],
                            'start_time' => $datum['start_time'],
                            'end_time' => $datum['end_time'],
                            'full_mark' => $datum['full_mark'],
                            'pass_mark' => $datum['pass_mark'],
                        ]
                    );
                }
            });
        });

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();
    }
}
