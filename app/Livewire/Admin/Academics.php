<?php

namespace App\Livewire\Admin;

use App\AgeRange;
use App\Models\Grade;
use App\Models\Staff;
use App\Models\Subject;
use App\Status;
use Livewire\Component;
use Filament\Actions\Action;
use Livewire\Attributes\Title;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Grid;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\CheckboxList;

#[Title('Academics')]
class Academics extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function grade(): Action
    {
        return CreateAction::make('grade')
            ->icon('c-folder-plus')
            ->label('Create grade')
            ->outlined()
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::ScreenMedium)
            ->modalHeading('Grade registration')
            ->modalDescription('Create a new grade')
            ->createAnother(false)
            ->form([
                Grid::make([
                    'md' => 3
                ])
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Grade 1')
                            ->required()
                            ->maxLength(100)
                            ->minLength(4)
                            ->autocomplete()
                            ->autofocus()
                            ->live(true),
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->placeholder('Click to select a date')
                            ->required()
                            ->native(false)
                            ->live(true),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->placeholder('Click to select a date')
                            ->required()
                            ->native(false)
                            ->live(true),
                    ]),
                Fieldset::make('Grade Metadata')
                    ->columns(3)
                    ->schema([
                        Select::make('year_head_id')
                            ->label('Year Head')
                            ->placeholder('Select a staff')
                            ->options(Staff::all()->pluck('name', 'id'))
                            ->searchable()
                            ->native(false),
                        Select::make('age_range')
                            ->label('Age Range')
                            ->placeholder('Select an Age Range')
                            ->options(AgeRange::class)
                            ->required()
                            ->searchable()
                            ->native(false),
                        Select::make('status')
                            ->placeholder('Select an option')
                            ->options(Status::class)
                            ->required()
                            ->native(false),
                    ]),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ])
            ->model(Grade::class)
            ->mutateFormDataUsing(function (array $data) {
                $data['user_id'] = auth()->id();
                return $data;
            })
            ->using(function (array $data, string $model): Model {
                return $model::create($data);
            })
            ->successNotificationTitle('Grade created')
            ->successRedirectUrl(route('app.admin.academics.grades'));
    }

    public function subject(): Action
    {
        return CreateAction::make('subject')
            ->icon('c-folder-plus')
            ->label('Create subject')
            ->outlined()
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Subject registration')
            ->modalDescription('Create a new subject')
            ->createAnother(false)
            ->form([
                Grid::make()
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Mathematics')
                            ->required()
                            ->maxLength(100)
                            ->minLength(1)
                            ->autocomplete()
                            ->autofocus()
                            ->live(true),
                        Select::make('type')
                            ->placeholder('Select an option')
                            ->options([
                                'theory' => 'Theory',
                                'practical' => 'Practical',
                                'combined' => 'Combined',
                            ])
                            ->required()
                            ->native(false),
                    ]),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ])
            ->model(Subject::class)
            ->mutateFormDataUsing(function (array $data) {
                $data['user_id'] = auth()->id();
                return $data;
            })
            ->using(function (array $data, string $model): Model {
                return $model::create($data);
            })
            ->successNotificationTitle('Subject created')
            ->successRedirectUrl(route('app.admin.academics.subjects'));
    }

    public function grade_subject(): Action
    {
        return CreateAction::make('grade_subject')
            ->icon('c-link')
            ->label('Grade Subject Link')
            ->outlined()
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Grade Subject Linking')
            ->modalDescription('Link a subject to a grade')
            ->modalSubmitActionLabel('Link')
            ->createAnother(false)
            ->form([
                Select::make('grades')
                    ->options(Grade::all()->pluck('name', 'id'))
                    ->multiple()
                    ->required()
                    ->searchable()
                    ->native(false),
                CheckboxList::make('subjects')
                    ->options(Subject::all()->pluck('name', 'id'))
                    ->required()
                    ->columns(2)
                    ->searchable()
                    ->bulkToggleable(),
            ])
            ->model(Grade::class)
            ->using(function (array $data, $model) {
                $grades = $model::query()->findMany($data['grades']);
                $subjects = Subject::query()->findMany($data['subjects']);

                foreach ($grades as $grade) {
                    $grade->subjects()->syncWithoutDetaching($subjects);
                }
            })
            ->successNotificationTitle('Linkage success');
    }
}
