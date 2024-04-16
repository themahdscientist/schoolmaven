<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Lga;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use App\Models\Guardian;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Livewire\Attributes\Title;
use Filament\Actions\CreateAction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Illuminate\Database\Eloquent\Builder;

#[Title('Admissions')]
class Admissions extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function student(): Action
    {
        return CreateAction::make('student')
            ->icon('c-user-plus')
            ->label('New Student')
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::FitContent)
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('Student Admissions')
            ->modalDescription('Enroll a student')
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
                        Select::make('marital_status')
                            ->label('Marital Status')
                            ->options(\App\MaritalStatus::class)
                            ->required()
                            ->native(false),
                        TextInput::make('occupation')
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

                $data['guardian_code'] = substr($date, 0, 2) . $model::query()->find(auth()->id())->school->smil_code . substr($date, -2) . $hour . $second;
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
                    $user->roles()->attach(Role::GUARDIAN);

                    // Guardian
                    $guardian = new Guardian;
                    $guardian->user_id = $user->id;
                    $guardian->guardian_code = $data['guardian_code'];
                    $guardian->marital_status = $data['marital_status'];
                    $guardian->occupation = $data['occupation'];
                    $guardian->save();

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
                    ->body('Guardian has been provisioned 🎉')
                    ->success()
            )
            ->successRedirectUrl(route('app.' . session('role') . '.students'));
    }

    public function guardian(): Action
    {
        return CreateAction::make('guardian')
            ->icon('c-user-plus')
            ->label('New Guardian')
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::FitContent)
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('Guardian Admissions')
            ->modalDescription('Enroll a guardian')
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
                        Select::make('marital_status')
                            ->label('Marital Status')
                            ->options(\App\MaritalStatus::class)
                            ->required()
                            ->native(false),
                        TextInput::make('occupation')
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

                $data['guardian_code'] = substr($date, 0, 2) . $model::query()->find(auth()->id())->school->smil_code . substr($date, -2) . $hour . $second;
                $data['username'] = substr($date, 0, 2) .
                    strtolower(Str::trim($data['first_name']) .
                        substr(Str::trim($data['last_name']), 0, 1) .
                        substr(Str::trim($data['last_name']), -1)) .
                    substr($date, -2) . $hour . $second;
                return $data;
            })
            ->using(function (array $data, string $model): Model {
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
                $user->roles()->attach(Role::GUARDIAN);

                // Guardian
                $guardian = new Guardian;
                $guardian->user_id = $user->id;
                $guardian->guardian_code = $data['guardian_code'];
                $guardian->marital_status = $data['marital_status'];
                $guardian->occupation = $data['occupation'];
                $guardian->save();

                event(new Registered($user));

                Notification::make()
                    ->title('Congratulations!')
                    ->body('You\ve been admitted successfully 🎉')
                    ->success()
                    ->sendToDatabase($user);

                return $user;
            })
            ->successNotification(
                Notification::make()
                    ->title('Admission Success')
                    ->body('Guardian has been provisioned 🎉')
                    ->success()
            )
            ->successRedirectUrl(route('app.' . session('role') . '.guardians'));
    }

    public function student_guardian(): Action
    {
        return CreateAction::make('student_guardian')
            ->icon('c-link')
            ->label('Student-Guardian Link')
            ->size(ActionSize::ExtraLarge)
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Student-Guardian Linking')
            ->modalDescription('Link a guardian to a student')
            ->modalSubmitActionLabel('Link')
            ->createAnother(false)
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
                Select::make('students')
                    ->label('Students')
                    ->multiple()
                    ->options(User::query()->whereHas('roles', function (Builder $query) {
                        $query->where('roles.id', Role::STUDENT);
                    })
                        ->pluck('first_name', 'id'))
                    ->required()
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->native(false),
            ])
            ->model(User::class)
            ->mutateFormDataUsing(function (array $data) {
                $data['guardian_id'] = Guardian::query()->where('user_id', $data['guardian_id'])->value('id');
                return $data;
            })
            ->using(function (array $data, string $model) {
                $users = $model::query()->findMany($data['students']);

                $users->each(function ($user) use ($data) {
                    DB::transaction(function () use ($user, $data) {
                        $user->student->guardian_id = $data['guardian_id'];
                        $user->student->save();
                    });
                });
            })
            ->successNotificationTitle('Linkage success');
    }
}
