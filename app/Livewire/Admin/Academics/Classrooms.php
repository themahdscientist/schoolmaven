<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Staff;
use App\Models\StaffRole;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Classrooms')]
class Classrooms extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Classrooms')
            ->description('Manage your classrooms here.')
            ->striped()
            ->headerActions([
                $this->staffClassroomLink(),
                $this->classroomCreateAction(),
            ])
            ->actions([
                ActionGroup::make([
                    $this->classroomEditAction(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
                $this->subjectsEditAction(),
            ], ActionsPosition::BeforeCells)
            ->query(Classroom::query())
            ->columns([
                TextColumn::make('#')
                    ->label('S/N')
                    ->searchable(false)
                    ->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('capacity'),
                TextColumn::make('subjects_count')
                    ->label('No. of Subjects')
                    ->counts('subjects')
                    ->searchable(false),
                TextColumn::make('formTeacher.user.full_name')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->label('Form Teacher')
                    ->placeholder('unassigned'),
                IconColumn::make('status')
                    ->icon(fn (Classroom $record): string => \App\Status::from($record->status)->getIcon())
                    ->color(fn (Classroom $record): string => \App\Status::from($record->status)->getColor())
                    ->tooltip(fn (Classroom $record): string => \App\Status::from($record->status)->getLabel()),

            ])
            ->emptyStateIcon('s-rectangle-stack')
            ->emptyStateHeading('No classrooms')
            ->emptyStateDescription('Create a classroom to get started')
            ->emptyStateActions([$this->classroomCreateAction()]);
    }

    public function classroomCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('s-folder-plus')
            ->label('Create classroom')
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Classroom registration')
            ->modalDescription('Create a new classroom')
            ->createAnother(false)
            ->form([
                Grid::make(['md' => 2])
                    ->schema([
                        TextInput::make('capacity')
                            ->placeholder('50')
                            ->integer()
                            ->required(),
                        Select::make('staff_id')
                            ->label('Form Teacher')
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
                        Select::make('grades')
                            ->label('Grades')
                            ->multiple()
                            ->options(Grade::all()->pluck('name', 'id'))
                            ->searchable()
                            ->live(true)
                            ->native(false)
                            ->required(),
                        Select::make('status')
                            ->options(\App\Status::class)
                            ->placeholder('Select an option')
                            ->required()
                            ->native(false),
                        CheckboxList::make('sections')
                            ->label('Sections')
                            ->options(Section::all()->pluck('name', 'id'))
                            ->bulkToggleable()
                            ->searchable()
                            ->required()
                            ->columns(3)
                            ->columnSpanFull(),
                    ]),
            ])
            ->model(Classroom::class)
            ->using(function (array $data, string $model): Model {
                return DB::transaction(function () use ($data, $model) {
                    $grades = Grade::query()->findMany($data['grades']);
                    $sections = Section::query()->findMany($data['sections']);
                    $grades->each(function (Grade $grade) use ($sections, $data, $model) {
                        $sections->each(function (Section $section) use ($grade, $data, $model) {
                            $model::query()->updateOrCreate([
                                'grade_id' => $grade->id,
                                'section_id' => $section->id,
                            ], [
                                'name' => $grade->name.$section->name,
                                'capacity' => $data['capacity'],
                                'staff_id' => $data['staff_id'],
                                'status' => $data['status'],
                            ]);
                        });
                    });

                    return $grades->first();
                });
            })
            ->successNotificationTitle('Classroom created');
    }

    public function classroomEditAction(): Action
    {
        return EditAction::make()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Classrooms')
            ->modalDescription('You can view and edit classroom information here')
            ->form([
                Grid::make(['md' => 2])
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('capacity')
                            ->placeholder('50')
                            ->integer()
                            ->required(),
                        Select::make('staff_id')
                            ->label('Form Teacher')
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
                        Select::make('status')
                            ->placeholder('Select an option')
                            ->options(\App\Status::class)
                            ->required()
                            ->native(false),
                        Select::make('grade_id')
                            ->label('Grades')
                            ->options(Grade::all()->pluck('name', 'id'))
                            ->searchable()
                            ->live(true)
                            ->native(false)
                            ->required()
                            ->disabled(),
                        Select::make('section_id')
                            ->label('Sections')
                            ->options(Section::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->disabled(),
                    ]),
            ]);
    }

    public function subjectsEditAction(): Action
    {
        return EditAction::make('subjects')
            ->label('Subjects')
            ->icon('s-rectangle-group')
            ->color('gray')
            ->button()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Classroom Subjects')
            ->modalDescription('You can view and assign subjects to a classroom')
            ->modalSubmitActionLabel('Save')
            ->form([
                CheckboxList::make('subjects')
                    ->label('Subjects offered')
                    ->relationship('subjects', 'name')
                    ->disableOptionWhen(function (string $value, Classroom $record) {
                        return ! in_array($value, Subject::query()
                            ->whereHas('grades', function (Builder $query) use ($record) {
                                $query->where('grades.id', $record->grade_id);
                            })
                            ->get()
                            ->pluck('name', 'id')
                            ->keys()
                            ->toArray()
                        );
                    })
                    ->columns(),
            ]);
    }

    public function staffClassroomLink(): Action
    {
        return CreateAction::make('staff_classroom')
            ->icon('s-squares-plus')
            ->label('Assign teachers')
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Staff Classroom Linking')
            ->modalDescription('Assign classrooms to staff members')
            ->modalSubmitActionLabel('Assign')
            ->createAnother(false)
            ->form([
                Select::make('teachers')
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
                    ->multiple()
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->hintIcon('s-exclamation-circle', 'This list contains only staff members who are teachers.')
                    ->hintColor('danger'),
                CheckboxList::make('classrooms')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->required()
                    ->columns()
                    ->searchable()
                    ->bulkToggleable(),
            ])
            ->model(Staff::class)
            ->using(function (array $data, $model): Staff {
                return DB::transaction(function () use ($data, $model) {
                    $teachers = $model::query()->findMany($data['teachers']);
                    $classrooms = Classroom::query()->findMany($data['classrooms']);

                    $teachers->each(function (Staff $teacher) use ($classrooms) {
                        $teacher->classrooms()->syncWithoutDetaching($classrooms);
                    });

                    return $teachers->first();
                });
            })
            ->successNotificationTitle('Linkage success')
            ->successRedirectUrl(route('app.'.session('role').'.staff'));
    }
}
