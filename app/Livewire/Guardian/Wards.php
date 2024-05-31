<?php

namespace App\Livewire\Guardian;

use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Wards')]
class Wards extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public User $record;

    public function mount()
    {
        $this->record = User::query()->find(auth()->id())->load(['student', 'student.classroom.grade', 'student.classroom.subjects']);
    }

    public function wardsInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->record)
            ->schema(function (User $record) {
                return $record->students->map(function (Student $student) {
                    return Split::make([
                        Grid::make(1)
                            ->schema([
                                ImageEntry::make('profile_picture')
                                    ->label('')
                                    ->circular()
                                    ->size(80)
                                    ->defaultImageUrl(Storage::url($student->user->avatar))
                                    ->alignCenter(),
                                Actions::make([
                                    Actions\Action::make($student->user->username)
                                        ->label('Subjects')
                                        ->icon('s-newspaper')
                                        ->modalWidth(MaxWidth::FitContent)
                                        ->modalHeading('Ward\'s Subjects')
                                        ->modalDescription('View your ward\'s subject here')
                                        ->modalSubmitAction(false)
                                        ->form([
                                            CheckboxList::make($student->user->first_name.'\'s Subjects')
                                                ->options(function () use ($student) {
                                                    return $student->classroom->subjects->map(function (Subject $subject) {
                                                        return $subject->name;
                                                    })->all();
                                                })
                                                ->descriptions(function () use ($student) {
                                                    return $student->classroom->subjects->map(function (Subject $subject) {
                                                        return $subject->type;
                                                    })->all();
                                                })
                                                ->columns(4)
                                                ->disabled(),
                                        ]),
                                ])
                                    ->alignCenter()
                                    ->verticallyAlignCenter(),
                            ])
                            ->grow(false),
                        Section::make(new HtmlString(
                            '<p class="uppercase font-bold">'.$student->user->first_name.' '.$student->user->middle_name.' '.$student->user->last_name.'</p>'
                        ))
                            ->description('Click to toggle collapse.')
                            ->icon('s-user')
                            ->schema([

                                TextEntry::make('admission_number')
                                    ->label('Admission Number')
                                    ->placeholder($student->admission_number),
                                TextEntry::make('grade_name')
                                    ->label('Grade Name')
                                    ->placeholder($student->classroom->grade->name),
                                TextEntry::make('classroom_name')
                                    ->label('Classroom Name')
                                    ->placeholder($student->classroom->name),
                                TextEntry::make('student_email')
                                    ->label('Email')
                                    ->placeholder($student->user->email),
                                TextEntry::make('student_gender')
                                    ->label('Gender')
                                    ->placeholder($student->user->gender),
                                TextEntry::make('student_religion')
                                    ->label('Religion')
                                    ->placeholder($student->user->religion),
                                TextEntry::make('student_phone')
                                    ->label('Phone')
                                    ->placeholder($student->user->phone),
                                TextEntry::make('blood_group')
                                    ->label('Blood Group')
                                    ->placeholder($student->blood_group),
                                TextEntry::make('rhesus_factor')
                                    ->label('Rhesus Factor')
                                    ->placeholder($student->rhesus_factor),
                            ])
                            ->columns(['sm' => 2, 'md' => 3])
                            ->collapsed(),
                    ]);
                })->all();
            });
    }
}
