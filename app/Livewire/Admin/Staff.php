<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Lga;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Staff as ModelsStaff;
use Filament\Forms\Components\Actions;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

#[Title('Staff')]
class Staff extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Staff')
            ->description('Manage your staff members here.')
            ->striped()
            ->headerActions([$this->staffCreateAction()])
            ->actions(
                ActionGroup::make([
                    $this->staffEditAction(),
                    DeleteAction::make(),
                ]),
                ActionsPosition::BeforeCells
            )
            ->query(User::query()->whereHas('roles', function (Builder $query) {
                $query->where('roles.id', Role::STAFF);
            }))
            ->columns([
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),
                TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn ($state, $record) => $state . ' ' . $record->last_name)
                    ->sortable(),
                TextColumn::make('email')
                    ->sortable(),
                TextColumn::make('phone')
                    ->sortable(),
                TextColumn::make('gender')
                    ->sortable(),
                TextColumn::make('religion')
                    ->sortable(),
                TextColumn::make('staff.marital_status')
                    ->label('Marital Status')
                    ->sortable(),
                TextColumn::make('staff.contract_type')
                    ->label('Contract Type')
                    ->sortable(),
                TextColumn::make('staff.salary')
                    ->label('Salary')
                    ->sortable(),
                IconColumn::make('status')
                    ->icon(fn (User $record): string => \App\StudentStatus::from($record->status)->getIcon())
                    ->color(fn (User $record): string => \App\StudentStatus::from($record->status)->getColor())
                    ->tooltip(fn (User $record): string => \App\StudentStatus::from($record->status)->getLabel()),
            ])
            ->emptyStateIcon('c-users')
            ->emptyStateHeading('No staff')
            ->emptyStateDescription('Create a staff member to get started')
            ->emptyStateActions([$this->staffCreateAction()]);
    }

    public function staffCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('c-document-plus')
            ->label('New Staff')
            ->modalWidth(MaxWidth::FitContent)
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('Staff Admissions')
            ->modalDescription('Enroll a staff member')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Staff bio-data.')
                    ->columns(2)
                    ->schema([
                        Select::make('position_title')
                            ->label('Position Title')
                            ->options(\App\PositionTitle::class)
                            ->required()
                            ->native(false),
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
                        Select::make('marital_status')
                            ->label('Marital Status')
                            ->options(\App\MaritalStatus::class)
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
                        TextInput::make('bank_account_number')
                            ->numeric()
                            ->label('Account Number')
                            ->placeholder('2034127047')
                            ->required(),
                        TextInput::make('bank_account_name')
                            ->label('Account Name')
                            ->placeholder('Emmanuel Akudinobi')
                            ->required(),
                        TextInput::make('bank_name')
                            ->label('Bank Name')
                            ->placeholder('FirstBank of Nigeria')
                            ->required(),
                        TextInput::make('salary')
                            ->numeric()
                            ->inputMode('decimal')
                            ->step(500)
                            ->prefix(new HtmlString('<strong>NGN</strong>'))
                            ->placeholder('150000')
                            ->required(),
                    ]),
                Step::make('Contact & Security Info')
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
                            ->hintIcon('c-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                            ->nullable(),
                        Select::make('contract_type')
                            ->label('Contract Type')
                            ->options(\App\ContractType::class)
                            ->required()
                            ->native(false),
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
                        Grid::make(1)
                            ->schema([
                                FileUpload::make('qualifications')
                                    ->hint(new HtmlString('Maximum of <strong>3</strong> documents'))
                                    ->hintIcon('c-exclamation-circle', 'Images and PDF documents are currently supported.')
                                    ->label('Qualifications')
                                    ->multiple()
                                    ->panelLayout('compact')
                                    ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg'])
                                    ->appendFiles()
                                    ->previewable(false)
                                    ->maxSize(1024)
                                    ->maxFiles(3)
                                    ->disk('public')
                                    ->directory('qualifications'),
                                TextInput::make('password')
                                    ->label('Password')
                                    ->placeholder('********')
                                    ->required()
                                    ->password()
                                    ->revealable(),
                            ])
                            ->columnSpan(1),
                        FileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->image()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('avatars'),
                        Textarea::make('notes')
                            ->placeholder('Type in here...')
                            ->columnSpanFull(),

                    ]),
            ])
            ->model(User::class)
            ->mutateFormDataUsing(function (array $data, string $model) {
                $date = Carbon::now()->year;
                $hour  = Carbon::now()->hour;
                $second  = Carbon::now()->second;

                $data['staff_code'] = substr($date, 0, 2) .
                    $model::query()->find(auth()->id())->school->smil_code .
                    substr($date, -2) . $hour . $second;
                $data['username'] = substr($date, 0, 2) .
                    strtolower(Str::trim($data['first_name']) .
                        substr(Str::trim($data['last_name']), 0, 1) .
                        substr(Str::trim($data['last_name']), -1)) .
                    substr($date, -2) . $hour . $second;
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
                    $user->roles()->attach(Role::STAFF);

                    // Staff
                    $staff = new ModelsStaff;
                    $staff->user_id = $user->id;
                    $staff->staff_code = $data['staff_code'];
                    $staff->position_title = $data['position_title'];
                    $staff->contract_type = $data['contract_type'];
                    $staff->marital_status = $data['marital_status'];
                    $staff->emergency_phone = '+234' . $data['emergency_phone'];
                    $staff->salary = $data['salary'];
                    $staff->bank_details = [
                        'bank_account_number' => $data['bank_account_number'],
                        'bank_account_name' => $data['bank_account_name'],
                        'bank_name' => $data['bank_name'],
                    ];
                    $staff->qualifications = $data['qualifications'];
                    $staff->notes = $data['notes'];
                    $staff->save();

                    event(new Registered($user));

                    Notification::make()
                        ->title('Congratulations!')
                        ->body('You\ve been admitted successfully 🎉')
                        ->success()
                        ->sendToDatabase($user);

                    return $user;
                });
            })
            ->successNotification(
                Notification::make()
                    ->title('Admission Success')
                    ->body('Staff member has been provisioned 🎉')
                    ->success()
            );
    }

    public function staffEditAction(): Action
    {
        return EditAction::make()
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Staff')
            ->modalDescription('You can view and edit staff member information here')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Staff bio-data.')
                    ->columns(2)
                    ->schema([
                        Select::make('staff.position_title')
                            ->label('Position Title')
                            ->options(\App\PositionTitle::class)
                            ->required()
                            ->native(false),
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
                        Select::make('staff.marital_status')
                            ->label('Marital Status')
                            ->options(\App\MaritalStatus::class)
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
                        TextInput::make('staff.bank_details.bank_account_number')
                            ->numeric()
                            ->label('Account Number')
                            ->placeholder('2034127047')
                            ->required(),
                        TextInput::make('staff.bank_details.bank_account_name')
                            ->label('Account Name')
                            ->placeholder('Emmanuel Akudinobi')
                            ->required(),
                        TextInput::make('staff.bank_details.bank_name')
                            ->label('Bank Name')
                            ->placeholder('FirstBank of Nigeria')
                            ->required(),
                        TextInput::make('staff.salary')
                            ->numeric()
                            ->prefix(new HtmlString('<strong>NGN</strong>'))
                            ->placeholder('150000')
                            ->required(),
                    ]),
                Step::make('Contact & Security Info')
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
                            ->hintIcon('c-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                            ->nullable(),
                        Select::make('staff.contract_type')
                            ->label('Contract Type')
                            ->options(\App\ContractType::class)
                            ->required()
                            ->native(false),
                        TextInput::make('phone')
                            ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                            ->tel()
                            ->label('Phone Number')
                            ->prefix('+234')
                            ->prefixIcon('c-phone')
                            ->placeholder('7059753934')
                            ->autocomplete()
                            ->required(),
                        TextInput::make('staff.emergency_phone')
                            ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                            ->label('Emergency Contact Number')
                            ->tel()
                            ->prefixIcon('c-phone')
                            ->prefix('+234')
                            ->placeholder('7059753934'),
                        Grid::make(1)
                            ->schema([
                                FileUpload::make('staff.qualifications')
                                    ->hint(new HtmlString('Maximum of <strong>3</strong> documents'))
                                    ->hintIcon('c-exclamation-circle', 'Images and PDF documents are currently supported.')
                                    ->label('Qualifications')
                                    ->multiple()
                                    ->panelLayout('compact')
                                    ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg'])
                                    ->appendFiles()
                                    ->previewable(false)
                                    ->maxSize(1024)
                                    ->maxFiles(3)
                                    ->disk('public')
                                    ->directory('qualifications'),
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
                                                ->body('On successful password update, every session logged in with this guardian will expire.')
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
                            ->columnSpan(1),
                        FileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->image()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(1024)
                            ->disk('public')
                            ->directory('avatars'),
                        Textarea::make('staff.notes')
                            ->placeholder('Type in here...')
                            ->columnSpanFull(),

                    ]),
            ])
            ->fillForm(fn (User $record) => $record->toArray())
            ->mutateFormDataUsing(function (array $data) {
                $data['staff']['emergency_phone'] = '+234' . $data['staff']['emergency_phone'];
                $data['phone'] = '+234' . $data['phone'];

                return $data;
            })
            ->using(function (User $record, array $data): User {
                return DB::transaction(function () use ($record, $data) {
                    $record->fill($data);
                    $record->save();

                    $record->staff->fill($data['staff']);
                    $record->staff->save();

                    return $record;
                });
            });
    }
}
