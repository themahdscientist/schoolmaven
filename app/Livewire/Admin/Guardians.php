<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Models\Guardian;
use App\Models\Lga;
use App\Models\Role;
use App\Models\State;
use App\Models\Student;
use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Guardians')]
class Guardians extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Guardians')
            ->description('Manage your guardians (parents) here.')
            ->striped()
            ->headerActions([$this->guardianCreateAction()])
            ->actions(
                [
                    ActionGroup::make([
                        $this->guardianEditAction(),
                        DeleteAction::make(),
                    ]),
                    $this->wardsViewAction(),
                ],
                ActionsPosition::BeforeCells
            )
            ->query(User::query()->whereHas('roles', function (Builder $query) {
                $query->where('roles.id', Role::GUARDIAN);
            }))
            ->columns([
                TextColumn::make('#')
                    ->label('S/N')
                    ->searchable(false)
                    ->rowIndex(),
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->sortable(),
                TextColumn::make('students_count')
                    ->label('No. of Wards')
                    ->counts('students')
                    ->searchable(false),
                TextColumn::make('email')
                    ->sortable(),
                TextColumn::make('phone')
                    ->sortable(),
                TextColumn::make('gender')
                    ->sortable(),
                TextColumn::make('religion')
                    ->sortable(),
                TextColumn::make('guardian.occupation')
                    ->label('Occupation')
                    ->sortable(),
                TextColumn::make('guardian.marital_status')
                    ->label('Marital Status')
                    ->sortable(),
                IconColumn::make('status')
                    ->icon(fn (User $record): string => \App\StudentStatus::from($record->status)->getIcon())
                    ->color(fn (User $record): string => \App\StudentStatus::from($record->status)->getColor())
                    ->tooltip(fn (User $record): string => \App\StudentStatus::from($record->status)->getLabel()),
            ])
            ->emptyStateIcon('s-user-group')
            ->emptyStateHeading('No guardians')
            ->emptyStateDescription('Create a guardian to get started')
            ->emptyStateActions([$this->guardianCreateAction()]);
    }

    public function guardianCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('s-document-plus')
            ->label('New Guardian')
            ->modalWidth(MaxWidth::FitContent)
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('Guardian Admissions')
            ->modalDescription('Enroll a guardian')
            ->modalSubmitActionLabel('Register')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Guardian bio-data.')
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
                            ->hintIcon('s-question-mark-circle', 'Valid email addresses only. This is the email address you\'ll use to sign in.'),
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
                        Select::make('marital_status')
                            ->label('Marital Status')
                            ->options(\App\MaritalStatus::class)
                            ->required()
                            ->native(false),
                        TextInput::make('occupation')
                            ->placeholder('Software Developer')
                            ->required(),
                    ]),
                Step::make('Contact & Account Info')
                    ->description('Residency & security data.')
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
                            ->hintIcon('s-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                            ->nullable(),
                        TextInput::make('phone')
                            ->tel()
                            ->label('Phone Number')
                            ->prefix('+234')
                            ->prefixIcon('s-phone')
                            ->placeholder('7059753934')
                            ->autocomplete()
                            ->required(),
                        TextInput::make('password')
                            ->label('Password')
                            ->placeholder('********')
                            ->required()
                            ->password()
                            ->revealable(),
                        FileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->image()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('avatars'),
                    ]),
            ])
            ->model(User::class)
            ->mutateFormDataUsing(function (array $data, string $model) {
                $date = now()->year;
                $hour = now()->hour;
                $second = now()->second;

                $data['guardian_code'] = substr($date, 0, 2).
                    $model::query()->find(auth()->id())->school->smil_code.
                    substr($date, -2).$hour.$second;
                $data['username'] = substr($date, 0, 2).
                    strtolower(Str::trim($data['first_name']).
                        substr(Str::trim($data['last_name']), 0, 1).
                        substr(Str::trim($data['last_name']), -1)).
                    substr($date, -2).$hour.$second;

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
                    $user->phone = '+234'.$data['phone'];
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
                    $user->roles()->attach(Role::GUARDIAN);

                    // Guardian
                    $guardian = new Guardian;
                    $guardian->user_id = $user->id;
                    $guardian->guardian_code = $data['guardian_code'];
                    $guardian->marital_status = $data['marital_status'];
                    $guardian->occupation = $data['occupation'];
                    $guardian->save();

                    event(new Registered($user));

                    return $user;
                });
            })
            ->after(function (User $record) {
                Notification::make()
                    ->title('Congratulations!')
                    ->body('You\'ve been registered 🎉')
                    ->success()
                    ->sendToDatabase($record);
            })
            ->successNotification(
                Notification::make()
                    ->title('Success')
                    ->body('Guardian has been registered 🎉')
                    ->success()
            );
    }

    public function guardianEditAction(): Action
    {
        return EditAction::make()
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Guardian')
            ->modalDescription('You can view and edit guardian information here')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Guardian bio-data.')
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
                            ->hintIcon('s-question-mark-circle', 'Valid email addresses only. This is the email address you\'ll use to sign in.'),
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
                        Select::make('guardian.marital_status')
                            ->label('Marital Status')
                            ->options(\App\MaritalStatus::class)
                            ->required()
                            ->native(false),
                        TextInput::make('guardian.occupation')
                            ->placeholder('Software Developer')
                            ->required(),
                    ]),
                Step::make('Contact & Account Info')
                    ->description('Residency & security data.')
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
                            ->hintIcon('s-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                            ->nullable(),
                        TextInput::make('phone')
                            ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                            ->tel()
                            ->label('Phone Number')
                            ->prefix('+234')
                            ->prefixIcon('s-phone')
                            ->placeholder('7059753934')
                            ->autocomplete()
                            ->required(),
                        Actions::make([
                            Actions\Action::make('Change Password')
                                ->icon('s-lock-closed')
                                ->iconSize(IconSize::Small)
                                ->modalWidth(MaxWidth::FitContent)
                                ->modalHeading('Change Password')
                                ->modalDescription('Create a new password for this guardian')
                                ->modalSubmitActionLabel('Change')
                                ->form([
                                    TextInput::make('password')
                                        ->label('New Password')
                                        ->password()
                                        ->revealable()
                                        ->required(),
                                ])
                                ->modalSubmitAction(function () {
                                    Notification::make()
                                        ->title('Info Alert')
                                        ->body('On successful password update, every session logged in with this guardian will expire.')
                                        ->info()
                                        ->send();
                                })
                                ->afterFormValidated(function (array $data, User $record) {
                                    $record->forceFill([
                                        'password' => Hash::make($data['password']),
                                    ]);
                                    $record->save();

                                    Notification::make()
                                        ->title('Password Updated')
                                        ->success()
                                        ->send();
                                }),
                        ])
                            ->alignCenter()
                            ->verticallyAlignCenter(),
                        FileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->image()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('avatars'),
                    ]),
            ])
            ->fillForm(fn (User $record) => $record->toArray())
            ->mutateFormDataUsing(function (array $data) {
                $data['phone'] = '+234'.$data['phone'];

                return $data;
            })
            ->using(function (User $record, array $data): User {
                return DB::transaction(function () use ($record, $data) {
                    $record->fill($data);
                    $record->save();

                    $record->guardian->fill($data['guardian']);
                    $record->guardian->save();

                    return $record;
                });
            });
    }

    public function wardsViewAction(): Action
    {
        return ViewAction::make('wards')
            ->label('Wards')
            ->icon('s-users')
            ->color('gray')
            ->button()
            ->modalWidth(MaxWidth::FitContent)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('View Wards')
            ->form(function (User $record) {
                return $record->students->map(function (Student $student) {
                    return Section::make(new HtmlString(
                        '<p class="uppercase font-bold">'.$student->user->first_name.' '.$student->user->middle_name.' '.$student->user->last_name.'</p>'
                    ))
                        ->description('Click to toggle collapse.')
                        ->icon('s-user')
                        ->schema([
                            TextInput::make('admission_number')
                                ->label('Admission Number')
                                ->placeholder($student->admission_number),
                            TextInput::make('grade_name')
                                ->label('Grade Name')
                                ->placeholder($student->grade->name),
                            TextInput::make('student_email')
                                ->label('Email')
                                ->placeholder($student->user->email),
                            TextInput::make('student_gender')
                                ->label('Gender')
                                ->placeholder($student->user->gender),
                            TextInput::make('student_religion')
                                ->label('Religion')
                                ->placeholder($student->user->religion),
                            TextInput::make('student_phone')
                                ->label('Phone')
                                ->placeholder($student->user->phone)
                                ->prefixIcon('s-phone'),
                            TextInput::make('blood_group')
                                ->label('Blood Group')
                                ->placeholder($student->blood_group),
                            TextInput::make('rhesus_factor')
                                ->label('Rhesus Factor')
                                ->placeholder($student->rhesus_factor),
                        ])
                        ->columns()
                        ->collapsed();
                })->all();
            });
    }
}
