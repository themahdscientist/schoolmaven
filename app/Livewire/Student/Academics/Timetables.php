<?php

namespace App\Livewire\Student\Academics;

use App\Models\Day;
use App\Models\Student;
use App\Models\Timetable;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Timetables')]
class Timetables extends Component implements HasForms
{
    use InteractsWithForms;

    public Student $student;

    public Collection $timetables;

    public ?array $data = [];

    public ?array $timetableData = [];

    public function mount(): void
    {
        $this->timetables = Student::query()
            ->where('user_id', auth()->id())
            ->first()->classroom->timetable;

        $this->timetables->each(function (Timetable $timetable) {
            $day = $timetable->day_id;

            if (! isset($this->timetableData[$day])) {
                $this->timetableData[$day] = [];
            }

            $this->timetableData[$day][] = [
                'subject' => $timetable->subject->name,
                'start_time' => $timetable->start_time,
                'end_time' => $timetable->end_time,
            ];
        });

        $this->form->fill();

        ksort($this->timetableData);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema(function () {
                        return collect($this->timetableData)->map(function ($entries, $day) {
                            return Section::make(Str::ucfirst(Day::query()->find($day, 'name')->name))
                                ->description('Click to toggle collapse.')
                                ->icon('s-calendar-days')
                                ->columns([
                                    'sm' => 2,
                                    'md' => 3,
                                ])
                                ->schema(function () use ($entries) {
                                    return collect($entries)->map(function ($entry) {
                                        return Fieldset::make(Str::upper($entry['subject']))
                                            ->schema([
                                                TextInput::make($entry['start_time'])
                                                    ->label('Start Time')
                                                    ->disabled()
                                                    ->default($entry['start_time']),
                                                TextInput::make($entry['end_time'])
                                                    ->label('End Time')
                                                    ->disabled()
                                                    ->default($entry['end_time']),
                                            ])
                                            ->columnSpan([
                                                'sm' => 1,
                                            ]);
                                    })
                                        ->all();
                                })
                                ->collapsible();
                        })->all();
                    }),
            ])
            ->statePath('data');
    }
}
