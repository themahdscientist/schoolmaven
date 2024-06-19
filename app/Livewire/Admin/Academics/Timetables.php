<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Classroom;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Timetable;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Timetable')]
class Timetables extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $search = true;

    public $timetable = false;

    public ?array $searchData = [];

    public ?array $createData = [];

    public function mount()
    {
        $this->searchEntries->fill();
        $this->createTimetable->fill();
    }

    protected function getForms(): array
    {
        return [
            'searchEntries',
            'createTimetable',
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
                            ->required()
                            ->afterStateUpdated(fn (Set $set) => $set('subject', null)),
                        Select::make('subject')
                            ->options(fn (Get $get) => Subject::query()
                                ->whereHas('classrooms', function (Builder $query) use ($get) {
                                    $query->where('classrooms.id', $get('classroom'));
                                })
                                ->get(['id', 'name'])
                                ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->live(true)
                            ->required()
                            ->native(false),
                    ]),
            ])
            ->statePath('searchData');
    }

    public function createTimetable(Form $form): Form
    {
        return $form
            ->model(Day::class)
            ->schema([$this->weekGrid()])
            ->statePath('createData');
    }

    public function weekGrid(): Grid
    {
        return Grid::make(3)
            ->schema(function (string $model) {
                return $model::all()->map(function (Day $day) {
                    return Section::make(new HtmlString("<p class='capitalize'>$day->name</p>"))
                        ->description('Click to toggle collapse.')
                        ->icon('s-calendar-days')
                        ->schema([
                            TimePicker::make($day->id.'.start_time')
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
                            TimePicker::make($day->id.'.end_time')
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
                        ->collapsible();
                })
                    ->all();
            });
    }

    public function generate(): void
    {
        $data = $this->searchEntries->getState();
        $entries = Timetable::query()
            ->where('classroom_id', $data['classroom'])
            ->where('subject_id', $data['subject'])
            ->get()
            ->keyBy('day_id')
            ->toArray();

        $formState = [];
        foreach ($entries as $day_id => $entry) {
            $formState[$day_id] = [
                'start_time' => $entry['start_time'],
                'end_time' => $entry['end_time'],
            ];
        }
        $this->createTimetable->fill($formState);
        $this->search = ! $this->search;
        $this->timetable = ! $this->timetable;
    }

    public function create(): void
    {
        $data = collect($this->searchEntries->getState())
            ->put('timetable', $this->createTimetable->getState());

        DB::transaction(function () use ($data) {
            collect($data['timetable'])->each(function ($datum, $index) use ($data) {
                if ($datum['start_time'] && $datum['end_time']) {
                    Timetable::query()->updateOrCreate(
                        [
                            'day_id' => $index,
                            'classroom_id' => $data['classroom'],
                            'subject_id' => $data['subject'],
                        ],
                        [
                            'start_time' => $datum['start_time'],
                            'end_time' => $datum['end_time'],
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
