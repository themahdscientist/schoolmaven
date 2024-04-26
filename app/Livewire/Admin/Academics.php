<?php

namespace App\Livewire\Admin;

use App\AgeRange;
use App\Models\Grade;
use App\Models\StaffRole;
use App\Models\Subject;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Academics')]
class Academics extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function grade(): Action
    {
        return CreateAction::make('grade')
            ->icon('s-folder-plus')
            ->label('Create grade')
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::ScreenMedium)
            ->modalHeading('Grade registration')
            ->modalDescription('Create a new grade')
            ->createAnother(false)
            ->form([
                Grid::make(['md' => 3])
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Grade 1')
                            ->required()
                            ->maxLength(100)
                            ->minLength(1)
                            ->autocomplete()
                            ->autofocus(),
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->placeholder('Click to select a date')
                            ->required()
                            ->native(false),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->placeholder('Click to select a date')
                            ->required()
                            ->native(false),
                    ]),
                Fieldset::make('Grade Metadata')
                    ->columns(3)
                    ->schema([
                        Select::make('year_head_id')
                            ->label('Year Head')
                            ->options(
                                User::query()
                                    ->join('staff', 'users.id', '=', 'staff.user_id')
                                    ->whereExists(function ($query) {
                                        $query->select(DB::raw(1))
                                            ->from('roles')
                                            ->join('role_user', 'roles.id', '=', 'role_user.role_id')
                                            ->whereColumn('users.id', 'role_user.user_id')
                                            ->where('name', 'staff');
                                    })
                                    ->where('staff.staff_type', StaffRole::TEACHING_STAFF)
                                    ->get(['first_name', 'middle_name', 'last_name', 'staff.id as staff_id'])
                                    ->pluck('full_name', 'staff_id')
                            )
                            ->searchable()
                            ->native(false)
                            ->hintIcon('s-exclamation-circle', 'This list contains only staff members who are teachers.')
                            ->hintColor('danger'),
                        Select::make('age_range')
                            ->label('Age Range')
                            ->placeholder('Select an Age Range')
                            ->options(AgeRange::class)
                            ->required()
                            ->native(false),
                        Select::make('status')
                            ->options(\App\Status::class)
                            ->placeholder('Select an option')
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
                return DB::transaction(function () use ($data, $model) {
                    return $model::create($data);
                });
            })
            ->successNotificationTitle('Grade created')
            ->successRedirectUrl(route('app.'.session('role').'.academics.grades'));
    }

    public function subject(): Action
    {
        return CreateAction::make('subject')
            ->icon('s-folder-plus')
            ->label('Create subject')
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
                            ->autofocus(),
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
                return DB::transaction(function () use ($data, $model) {
                    return $model::create($data);
                });
            })
            ->successNotificationTitle('Subject created')
            ->successRedirectUrl(route('app.'.session('role').'.academics.subjects'));
    }

    public function grade_subject(): Action
    {
        return CreateAction::make('grade_subject')
            ->icon('s-link')
            ->label('Grade-Subject Link')
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Grade-Subject Linking')
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
                    ->columns()
                    ->searchable()
                    ->bulkToggleable(),
            ])
            ->model(Grade::class)
            ->using(function (array $data, $model): Grade {
                return DB::transaction(function () use ($data, $model) {
                    $grades = $model::query()->findMany($data['grades']);
                    $subjects = Subject::query()->findMany($data['subjects']);

                    $grades->each(function (Grade $grade) use ($subjects) {
                        $grade->subjects()->syncWithoutDetaching($subjects);
                    });

                    return $grades->first();
                });
            })
            ->successNotificationTitle('Linkage success')
            ->successRedirectUrl(route('app.'.session('role').'.academics.grades'));
    }
}
