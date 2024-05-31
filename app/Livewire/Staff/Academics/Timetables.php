<?php

namespace App\Livewire\Staff\Academics;

use App\Models\Classroom;
use App\Models\Day;
use App\Models\Timetable;
use App\Models\User;
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

    public Collection $classrooms;

    public ?array $data = [];

    public ?array $timetableData = [];

    public function mount()
    {
        $this->classrooms = User::query()->find(auth()->id())
            ->staff->classrooms()
            ->pluck('classrooms.id');

        Timetable::all()->whereIn('classroom_id', $this->classrooms)
            ->each(function (Timetable $timetable) {
                $classroom = $timetable->classroom_id;
                $day = $timetable->day_id;

                if (! isset($this->timetableData[$classroom])) {
                    $this->timetableData[$classroom] = [];
                }

                if (! isset($this->timetableData[$classroom][$day])) {
                    $this->timetableData[$classroom][$day] = [];
                }

                $this->timetableData[$classroom][$day][] = [
                    'subject' => $timetable->subject->name,
                    'start_time' => $timetable->start_time,
                    'end_time' => $timetable->end_time,
                ];

                ksort($this->timetableData[$classroom]);
                ksort($this->timetableData);
            });

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema(function () {
                        return collect($this->timetableData)->map(function ($entries, $classroom) {
                            return Section::make(Str::ucfirst(Classroom::query()->find($classroom, 'name')->name))
                                ->description('Click to toggle collapse.')
                                ->icon('s-rectangle-stack')
                                ->schema(function () use ($entries) {
                                    return collect($entries)->map(function ($entry, $day) {
                                        return Section::make(Str::ucfirst(Day::query()->find($day, 'name')->name))
                                            ->description('Click to toggle collapse.')
                                            ->icon('s-calendar-days')
                                            ->columns([
                                                'sm' => 2,
                                                'md' => 3,
                                            ])
                                            ->schema(function () use ($entry) {
                                                return collect($entry)->map(function ($record) {
                                                    return Fieldset::make(Str::upper($record['subject']))
                                                        ->schema([
                                                            TextInput::make($record['start_time'])
                                                                ->label('Start Time')
                                                                ->disabled()
                                                                ->default($record['start_time']),
                                                            TextInput::make($record['end_time'])
                                                                ->label('End Time')
                                                                ->disabled()
                                                                ->default($record['end_time']),
                                                        ])
                                                        ->columnSpan([
                                                            'sm' => 1,
                                                        ]);
                                                })
                                                    ->all();
                                            })
                                            ->collapsible();
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
