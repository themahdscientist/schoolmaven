<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Lga;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\State;
use App\Models\Country;
use App\Models\Guardian;
use App\Models\Student;
use Filament\Forms\Components\Actions;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Collection;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Auth\Events\Registered;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

#[Title('Student')]
class Students extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Students')
            ->description('Manage your students here.')
            ->striped()
            ->headerActions([$this->studentCreateAction()])
            ->bulkActions([
                BulkAction::make('link_a_guardian')
                    ->icon('c-link')
                    ->modalWidth(MaxWidth::Medium)
                    ->modalHeading('Student-Guardian Linking')
                    ->modalDescription('Link a guardian to a student')
                    ->modalSubmitActionLabel('Link')
                    ->form([
                        Select::make('guardian_id')
                            ->label('Guardian')
                            ->options(User::query()->whereHas('roles', function (Builder $query) {
                                $query->where('roles.id', Role::GUARDIAN);
                            })
                                ->pluck('last_name', 'id'))
                            ->required()
                            ->searchable()
                            ->native(false),
                    ])
                    ->mutateFormDataUsing(function (array $data) {
                        $data['guardian_id'] = Guardian::query()->where('user_id', $data['guardian_id'])->value('id');
                        return $data;
                    })
                    ->action(function (EloquentCollection $records, array $data) {
                        $records->each(function (User $record) use ($data) {
                            DB::transaction(function () use ($record, $data) {
                                $record->student->guardian_id = $data['guardian_id'];
                                $record->student->save();
                            });
                        });

                        Notification::make()
                            ->title('Linkage success')
                            ->success()
                            ->send();
                    })
                    ->deselectRecordsAfterCompletion()
            ])
            ->selectCurrentPageOnly()
            ->actions(
                ActionGroup::make([
                    $this->studentEditAction(),
                    DeleteAction::make(),
                ]),
                ActionsPosition::BeforeCells,
            )
            ->query(User::query()->whereHas('roles', function (Builder $query) {
                $query->where('roles.id', Role::STUDENT);
            }))
            ->columns([
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),
                TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn ($state, User $record) => $state . ' ' . $record->last_name)
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->sortable(),
                TextColumn::make('student.admission_number')
                    ->label('Admission Number')
                    ->sortable(),
                TextColumn::make('student.grade.name')
                    ->sortable(),
                TextColumn::make('email')
                    ->sortable(),
                TextColumn::make('student.guardian.user.first_name')
                    ->label('Guardian')
                    ->formatStateUsing(fn ($state, $record) => $state . ' ' . $record->student->guardian->user->last_name)
                    ->action(
                        ViewAction::make('guardian')
                            ->modalWidth(MaxWidth::FitContent)
                            ->stickyModalHeader()
                            ->stickyModalFooter()
                            ->modalHeading('View Guardian')
                            ->form([
                                Grid::make(3)
                                    ->schema([
                                        FileUpload::make('student.guardian.user.avatar')
                                            ->deletable(false),
                                        Grid::make()
                                            ->schema([
                                                TextInput::make('student.guardian.user.first_name')
                                                    ->label('First Name'),
                                                TextInput::make('student.guardian.user.middle_name')
                                                    ->label('Middle Name'),
                                                TextInput::make('student.guardian.user.last_name')
                                                    ->label('Last Name'),
                                                TextInput::make('student.guardian.user.gender')
                                                    ->label('Gender'),
                                                DatePicker::make('student.guardian.user.dob')
                                                    ->label('Date of Birth'),
                                                TextInput::make('student.guardian.marital_status')
                                                    ->label('Marital Status'),
                                                TextInput::make('student.guardian.user.phone')
                                                    ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                                                    ->prefixIcon('c-phone')
                                                    ->prefix('+234'),
                                                TextInput::make('student.guardian.occupation'),
                                                TextInput::make('student.guardian.guardian_code')
                                                    ->label('Guardian Code'),
                                                TextInput::make('student.guardian.user.username')
                                                    ->label('Username'),
                                            ])
                                            ->columnSpan(2),
                                    ]),
                            ])
                            ->fillForm(fn (User $record) => $record->toArray())
                    )
                    ->placeholder('unassigned')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->sortable(),
                TextColumn::make('phone')
                    ->sortable(),
                TextColumn::make('gender')
                    ->sortable(),
                TextColumn::make('religion')
                    ->sortable(),
                IconColumn::make('student.status')
                    ->label('Status')
                    ->icon(fn (User $record): string => \App\StudentStatus::from($record->student->status)->getIcon())
                    ->color(fn (User $record): string => \App\StudentStatus::from($record->student->status)->getColor())
                    ->tooltip(fn (User $record): string => \App\StudentStatus::from($record->student->status)->getLabel()),
            ])
            ->emptyStateIcon('c-user-group')
            ->emptyStateHeading('No students')
            ->emptyStateDescription('Create a student to get started')
            ->emptyStateActions([$this->studentCreateAction()]);
    }

    public function studentCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('c-document-plus')
            ->label('New Student')
            ->modalWidth(MaxWidth::FitContent)
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('Student Admissions')
            ->modalDescription('Enroll a student')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Student bio-data.')
                    ->columns()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->placeholder('Ifeanyichukwu')
                            ->required()
                            ->maxLength(255)
                            ->minLength(2)
                            ->autocomplete()
                            ->autofocus(),
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->autocomplete()
                            ->minLength(2)
                            ->placeholder('Noel')
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->autocomplete()
                            ->placeholder('Akudinobi')
                            ->required()
                            ->minLength(2)
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->label('Email Address')
                            ->autocomplete()
                            ->placeholder('tms@skoolmaven.com')
                            ->required()
                            ->maxLength(255)
                            ->unique('users', 'email')
                            ->hintIcon('c-question-mark-circle', 'Valid email addresses only. This is the email address you\'ll use to sign in.'),
                        Select::make('gender')
                            ->label('Gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->placeholder('Click to select a date')
                            ->required()
                            ->native(false),
                        Select::make('religion')
                            ->label('Religion')
                            ->options([
                                'christianity' => 'Christianity',
                                'islam' => 'Islam',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('nationality_id')
                            ->label('Nationality')
                            ->placeholder('Select an option')
                            ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                            ->default(Country::query()->find(1)->value('id'))
                            ->disabled()
                            ->required()
                            ->native(false),
                        Select::make('state_origin_id')
                            ->label('State of Origin')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('nationality_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true)
                            ->afterStateUpdated(fn (Set $set) => $set('lga_origin_id', null)),
                        Select::make('lga_origin_id')
                            ->label('LGA')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true),
                    ]),
                Step::make('Contact & Location Info')
                    ->description('Residency & health data.')
                    ->columns()
                    ->schema([
                        TextInput::make('address')
                            ->label('Address')
                            ->autocomplete()
                            ->placeholder('No. 1 Ekwema Crescent, Ikenegbu')
                            ->required()
                            ->maxLength(255),
                        Select::make('country_id')
                            ->label('Country of Residence')
                            ->placeholder('Select an option')
                            ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                            ->default(Country::query()->find(1)->value('id'))
                            ->disabled()
                            ->required()
                            ->native(false),
                        Select::make('state_id')
                            ->label('State of Residence')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('country_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true)
                            ->afterStateUpdated(fn (Set $set) => $set('lga_id', null)),
                        Select::make('lga_id')
                            ->label('City of Residence')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get): Collection => Lga::query()->where('state_id', (int) $get('state_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true),
                        TextInput::make('postal_code')
                            ->numeric()
                            ->label('Postal Code')
                            ->placeholder('460242')
                            ->autocomplete()
                            ->hintIcon('c-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                            ->nullable(),
                        TextInput::make('phone')
                            ->tel()
                            ->label('Phone Number')
                            ->prefix('+234')
                            ->prefixIcon('c-phone')
                            ->placeholder('7059753934')
                            ->autocomplete()
                            ->required(),
                        TextInput::make('emergency_phone')
                            ->label('Emergency Contact Number')
                            ->tel()
                            ->prefixIcon('c-phone')
                            ->prefix('+234')
                            ->placeholder('7059753934'),
                        Select::make('guardian_id')
                            ->label('Guardian (Parent)')
                            ->placeholder('Select a guardian')
                            ->options(User::query()->whereHas('roles', function (Builder $query) {
                                $query->where('roles.id', Role::GUARDIAN);
                            })
                                ->pluck('last_name', 'id'))
                            ->searchable()
                            ->nullable()
                            ->native(false),
                        Select::make('blood_group')
                            ->label('Blood Group')
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'AB' => 'AB',
                                'O' => 'O',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('rhesus_factor')
                            ->label('Rhesus')
                            ->options([
                                'Rh+' => 'Rh+',
                                'Rh-' => 'Rh-',
                            ])
                            ->required()
                            ->native(false),
                    ]),
                Step::make('Account & Security Info')
                    ->description('Grade, passport, and password data.')
                    ->columns()
                    ->schema([
                        Select::make('grade_id')
                            ->label('Grade')
                            ->options(Grade::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false),
                        TextInput::make('password')
                            ->label('Password')
                            ->placeholder('********')
                            ->required()
                            ->password()
                            ->revealable(),
                        FileUpload::make('avatar')
                            ->label('Passport')
                            ->image()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('avatars')
                    ])
            ])
            ->model(User::class)
            ->mutateFormDataUsing(function (array $data, string $model) {
                $date = Carbon::now()->year;
                $hour  = Carbon::now()->hour;
                $second  = Carbon::now()->second;
                $school = $model::query()->find(auth()->id())->school;

                $last_student = Student::query()->whereHas('user.school', function (Builder $query) use ($school) {
                    $query->where('id', $school->id);
                })
                    ->latest('admission_number')
                    ->first();

                $serial = $last_student ? intval(substr($last_student->admission_number, 6, 4)) + 1 : 1;
                $serial = str_pad($serial, 4, '0', STR_PAD_LEFT);
                $smil_code = $school->smil_code;
                $code = substr($smil_code, 0, 4);
                $first = substr($date, 0, 2);
                $last = substr($date, -2);

                $data['admission_number'] = $first . $code . $serial . $last;
                $data['username'] = substr($date, 0, 2) .
                    strtolower(Str::trim($data['first_name']) .
                        substr(Str::trim($data['last_name']), 0, 1) .
                        substr(Str::trim($data['last_name']), -1)) .
                    substr($date, -2) . $hour . $second;
                $data['guardian_id'] = Guardian::query()->where('user_id', $data['guardian_id'])->value('id');
                return $data;
            })
            ->using(function (array $data, string $model): Model {
                return DB::transaction(function () use ($data, $model) {
                    $user = new $model;
                    $user->school_id = $model::query()->find(auth()->id())->school->id;
                    $user->username = $data['username'];
                    $user->email = $data['email'];
                    $user->password = $data['password'];
                    $user->first_name = $data['first_name'];
                    $user->middle_name = $data['middle_name'];
                    $user->last_name = $data['last_name'];
                    $user->gender = $data['gender'];
                    $user->dob = $data['dob'];
                    $user->religion = $data['religion'];
                    $user->phone = '+234' . $data['phone'];
                    $user->address = $data['address'];
                    $user->postal_code = $data['postal_code'];
                    $user->lga_id = $data['lga_id'];
                    $user->state_id = $data['state_id'];
                    $user->country_id = 1;
                    $user->lga_origin_id = $data['lga_origin_id'];
                    $user->state_origin_id = $data['state_origin_id'];
                    $user->nationality_id = 1;
                    $user->avatar = $data['avatar'];
                    $user->save();
                    $user->roles()->attach(Role::STUDENT);

                    // Student
                    $student = new Student;
                    $student->user_id = $user->id;
                    $student->guardian_id = $data['guardian_id'];
                    $student->grade_id = $data['grade_id'];
                    $student->admission_number = $data['admission_number'];
                    $student->blood_group = $data['blood_group'];
                    $student->rhesus_factor = $data['rhesus_factor'];
                    $student->emergency_phone = '+234' . $data['emergency_phone'];
                    $student->save();

                    event(new Registered($user));

                    Notification::make()
                        ->title('Congratulations!')
                        ->body('You\ve been given provisional admission 🎉')
                        ->success()
                        ->sendToDatabase($user);

                    return $user;
                });
            })
            ->successNotification(
                Notification::make()
                    ->title('Admission Success')
                    ->body('Student has been provisioned 🎉')
                    ->success()
            );
    }

    public function studentEditAction(): Action
    {
        return EditAction::make()
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Student')
            ->modalDescription('You can view and edit student information here')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Student bio-data.')
                    ->columns()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->placeholder('Ifeanyichukwu')
                            ->required()
                            ->maxLength(255)
                            ->minLength(2)
                            ->autocomplete()
                            ->autofocus(),
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->autocomplete()
                            ->minLength(2)
                            ->placeholder('Noel')
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->autocomplete()
                            ->placeholder('Akudinobi')
                            ->required()
                            ->minLength(2)
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->label('Email Address')
                            ->autocomplete()
                            ->placeholder('tms@skoolmaven.com')
                            ->required()
                            ->maxLength(255)
                            ->hintIcon('c-question-mark-circle', 'Valid email addresses only. This is the email address you\'ll use to sign in.'),
                        Select::make('gender')
                            ->label('Gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->placeholder('Click to select a date')
                            ->required()
                            ->native(false),
                        Select::make('religion')
                            ->label('Religion')
                            ->options([
                                'christianity' => 'Christianity',
                                'islam' => 'Islam',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('nationality_id')
                            ->label('Nationality')
                            ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                            ->default(Country::query()->find(1)->value('id'))
                            ->disabled()
                            ->required()
                            ->native(false),
                        Select::make('state_origin_id')
                            ->label('State of Origin')
                            ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('nationality_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true)
                            ->afterStateUpdated(fn (Set $set) => $set('lga_origin_id', null)),
                        Select::make('lga_origin_id')
                            ->label('LGA')
                            ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true),
                    ]),
                Step::make('Contact & Location Info')
                    ->description('Residency & health data.')
                    ->columns()
                    ->schema([
                        TextInput::make('address')
                            ->label('Address')
                            ->autocomplete()
                            ->placeholder('No. 1 Ekwema Crescent, Ikenegbu')
                            ->required()
                            ->maxLength(255),
                        Select::make('country_id')
                            ->label('Country of Residence')
                            ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                            ->default(Country::query()->find(1)->value('id'))
                            ->disabled()
                            ->required()
                            ->native(false),
                        Select::make('state_id')
                            ->label('State of Residence')
                            ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('country_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true)
                            ->afterStateUpdated(fn (Set $set) => $set('lga_id', null)),
                        Select::make('lga_id')
                            ->label('City of Residence')
                            ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_id'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true),
                        TextInput::make('postal_code')
                            ->numeric()
                            ->label('Postal Code')
                            ->placeholder('460242')
                            ->autocomplete()
                            ->hintIcon('c-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                            ->nullable(),
                        TextInput::make('phone')
                            ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                            ->label('Phone Number')
                            ->tel()
                            ->prefix('+234')
                            ->prefixIcon('c-phone')
                            ->placeholder('7059753934')
                            ->autocomplete()
                            ->required(),
                        TextInput::make('student.emergency_phone')
                            ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                            ->label('Emergency Contact Number')
                            ->tel()
                            ->prefixIcon('c-phone')
                            ->prefix('+234')
                            ->placeholder('7059753934')
                            ->autocomplete()
                            ->required(),
                        Select::make('student.guardian.user.id')
                            ->label('Guardian (Parent)')
                            ->options(User::query()->whereHas('roles', function (Builder $query) {
                                $query->where('roles.id', Role::GUARDIAN);
                            })
                                ->pluck('last_name', 'id'))
                            ->searchable()
                            ->nullable()
                            ->native(false),
                        Select::make('student.blood_group')
                            ->label('Blood Group')
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'AB' => 'AB',
                                'O' => 'O',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('student.rhesus_factor')
                            ->label('Rhesus')
                            ->options([
                                'Rh+' => 'Rh+',
                                'Rh-' => 'Rh-',
                            ])
                            ->required()
                            ->native(false),
                    ]),
                Step::make('Account & Security Info')
                    ->description('Grade, passport, and password data.')
                    ->columns()
                    ->schema([
                        Select::make('student.grade_id')
                            ->label('Grade')
                            ->options(Grade::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false),
                        Select::make('student.status')
                            ->options(\App\StudentStatus::class)
                            ->required()
                            ->native(false),
                        FileUpload::make('avatar')
                            ->label('Passport')
                            ->image()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('avatars'),
                        Actions::make([
                            Actions\Action::make('Change Password')
                                ->icon('c-lock-closed')
                                ->iconSize(IconSize::Small)
                                ->modalWidth(MaxWidth::FitContent)
                                ->modalHeading('Change Password')
                                ->modalDescription('Confirm your old password before creating a new one')
                                ->modalSubmitActionLabel('Change')
                                ->form([
                                    TextInput::make('password')
                                        ->label('Current Password')
                                        ->password()
                                        ->revealable()
                                        ->required(),
                                    TextInput::make('new_password')
                                        ->label('New Password')
                                        ->password()
                                        ->revealable()
                                        ->required(),
                                ])
                                ->modalSubmitAction(function () {
                                    Notification::make()
                                        ->title('Info Alert')
                                        ->body('On successful password update, every session logged in with this student will expire.')
                                        ->info()
                                        ->send();
                                })
                                ->afterFormValidated(function (array $data, User $record) {
                                    if (Hash::check($data['password'], $record->password)) {
                                        $record->forceFill([
                                            'password' => Hash::make($data['new_password'])
                                        ]);
                                        $record->save();

                                        Notification::make()
                                            ->title('Password Updated')
                                            ->success()
                                            ->send();
                                    } else {
                                        $this->form->fill();
                                        Notification::make()
                                            ->title('Password Update Declined')
                                            ->body('The password do not match our records')
                                            ->danger()
                                            ->send();
                                    }
                                })
                        ])
                            ->alignCenter()
                            ->verticallyAlignCenter(),
                    ])
            ])
            ->fillForm(fn (User $record) => $record->toArray())
            ->mutateFormDataUsing(function (array $data) {
                $data['student']['emergency_phone'] = '+234' . $data['student']['emergency_phone'];
                $data['phone'] = '+234' . $data['phone'];
                $data['student']['guardian_id'] = Guardian::query()->where('user_id', $data['student']['guardian']['user']['id'])->value('id');
                unset($data['student']['guardian']);

                return $data;
            })
            ->using(function (User $record, array $data): User {
                return DB::transaction(function () use ($record, $data) {
                    $record->fill($data);
                    $record->save();

                    $record->student->fill($data['student']);
                    $record->student->save();

                    return $record;
                });
            });
    }
}
