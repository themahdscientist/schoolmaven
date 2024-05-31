<?php

namespace App\Livewire\Admin\Academics;

use App\AgeRange;
use App\Models\Grade;
use App\Models\StaffRole;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Grades')]
class Grades extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Grades')
            ->description('Manage your grades (classes) here.')
            ->striped()
            ->headerActions([
                $this->gradeSubjectLink(),
                $this->gradeCreateAction(),
            ])
            ->actions([
                ActionGroup::make([
                    $this->gradeEditAction(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
                $this->subjectsEditAction(),
            ], ActionsPosition::BeforeCells)
            ->query(Grade::query())
            ->columns([
                TextColumn::make('#')
                    ->label('S/N')
                    ->searchable(false)
                    ->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('staff.user.full_name')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->label('Year Head')
                    ->placeholder('unassigned'),
                TextColumn::make('subjects_count')
                    ->label('No. of Subjects')
                    ->counts('subjects')
                    ->searchable(false),
                TextColumn::make('age_range')
                    ->label('Age Range'),
                TextColumn::make('assessment_methods')
                    ->listWithLineBreaks()
                    ->limitList(1)
                    ->expandableLimitedList(),
                TextColumn::make('meeting_methods')
                    ->listWithLineBreaks()
                    ->limitList(1)
                    ->expandableLimitedList(),
                TextColumn::make('meeting_frequency'),
                TextColumn::make('user.full_name')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->label('Created by'),
                IconColumn::make('status')
                    ->icon(fn (Grade $record): string => \App\Status::from($record->status)->getIcon())
                    ->color(fn (Grade $record): string => \App\Status::from($record->status)->getColor())
                    ->tooltip(fn (Grade $record): string => \App\Status::from($record->status)->getLabel()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(\App\Status::class)
                    ->native(false)
                    ->placeholder('Select an option'),
            ])
            ->emptyStateIcon('s-view-columns')
            ->emptyStateHeading('No grades')
            ->emptyStateDescription('Create a grade to get started')
            ->emptyStateActions([$this->gradeCreateAction()]);
    }

    public function gradeCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('s-folder-plus')
            ->label('Create grade')
            ->modalWidth(MaxWidth::FitContent)
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
                        Select::make('assessment_methods')
                            ->label('Assessment Methods')
                            ->placeholder('Select one or more options')
                            ->multiple()
                            ->options(\App\AssessmentMethods::class)
                            ->required()
                            ->native(false),
                        Select::make('meeting_methods')
                            ->label('Meeting Methods')
                            ->placeholder('Select one or more options')
                            ->multiple()
                            ->options(\App\MeetingMethods::class)
                            ->required()
                            ->native(false),
                        Select::make('meeting_frequency')
                            ->label('Meeting Frequency')
                            ->placeholder('Select an option')
                            ->options(\App\MeetingFrequency::class)
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
            ->successNotificationTitle('Grade created');
    }

    public function gradeEditAction(): Action
    {
        return EditAction::make()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Grades')
            ->modalDescription('You can view and edit grade information here')
            ->form([
                Grid::make([
                    'md' => 3,
                ])
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Grade 1')
                            ->required()
                            ->maxLength(100)
                            ->minLength(4)
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
                            ->native(false),
                        Select::make('age_range')
                            ->label('Age Range')
                            ->placeholder('Select an Age Range')
                            ->options(AgeRange::class)
                            ->required()
                            ->native(false),
                        Select::make('assessment_methods')
                            ->label('Assessment Methods')
                            ->placeholder('Select one or more options')
                            ->multiple()
                            ->options(\App\AssessmentMethods::class)
                            ->required()
                            ->native(false),
                        Select::make('meeting_methods')
                            ->label('Meeting Methods')
                            ->placeholder('Select one or more options')
                            ->multiple()
                            ->options(\App\MeetingMethods::class)
                            ->required()
                            ->native(false),
                        Select::make('meeting_frequency')
                            ->label('Meeting Frequency')
                            ->placeholder('Select an option')
                            ->options(\App\MeetingFrequency::class)
                            ->required()
                            ->native(false),
                        Select::make('status')
                            ->placeholder('Select an option')
                            ->options(\App\Status::class)
                            ->required()
                            ->native(false),
                    ]),
                CheckboxList::make('subjects')
                    ->label('Subjects offered')
                    ->columns(3)
                    ->relationship('subjects', 'name'),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ])
            ->fillForm(fn (Grade $record) => $record->toArray());
    }

    public function gradeSubjectLink(): Action
    {
        return CreateAction::make('grade_subject')
            ->icon('s-link')
            ->label('Link a subject')
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
            ->successNotificationTitle('Linkage success');
    }

    public function subjectsEditAction(): Action
    {
        return EditAction::make('subjects')
            ->label('Subjects')
            ->icon('s-rectangle-group')
            ->color('gray')
            ->button()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Grade Subjects')
            ->modalDescription('You can view and assign subjects to a grade')
            ->modalSubmitActionLabel('Update')
            ->form([
                CheckboxList::make('subjects')
                    ->label('Subjects offered')
                    ->columns(3)
                    ->relationship('subjects', 'name')
                    ->bulkToggleable(),
            ]);
    }
}
