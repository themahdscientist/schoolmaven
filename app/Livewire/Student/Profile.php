<?php

namespace App\Livewire\Student;

use App\Models\Classroom;
use App\Models\Country;
use App\Models\Grade;
use App\Models\Guardian;
use App\Models\Lga;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Profile')]
class Profile extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public User $record;

    public function mount(): void
    {
        $this->record = User::query()->find(auth()->id());
        $this->form->fill($this->record->load(['student.guardian.user', 'student.classroom.grade'])->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make('Personal Info')
                        ->description('Student bio-data.')
                        ->columns()
                        ->schema([
                            TextInput::make('student.admission_number')
                                ->label('Admission Number')
                                ->disabled(),
                            TextInput::make('username'),
                            TextInput::make('first_name')
                                ->label('First Name')
                                ->disabled()
                                ->placeholder('Ifeanyichukwu')
                                ->required()
                                ->maxLength(255)
                                ->minLength(2)
                                ->autocomplete(),
                            TextInput::make('middle_name')
                                ->label('Middle Name')
                                ->disabled()
                                ->autocomplete()
                                ->minLength(2)
                                ->placeholder('Noel')
                                ->maxLength(255),
                            TextInput::make('last_name')
                                ->label('Last Name')
                                ->disabled()
                                ->autocomplete()
                                ->placeholder('Akudinobi')
                                ->required()
                                ->minLength(2)
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->label('Email Address')
                                ->disabled()
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
                                ->disabled()
                                ->native(false),
                            DatePicker::make('dob')
                                ->label('Date of Birth')
                                ->disabled()
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
                                ->disabled()
                                ->searchable()
                                ->required()
                                ->native(false)
                                ->afterStateUpdated(fn (Set $set) => $set('lga_origin_id', null)),
                            Select::make('lga_origin_id')
                                ->label('LGA')
                                ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin_id'))->pluck('name', 'id'))
                                ->disabled()
                                ->searchable()
                                ->required()
                                ->native(false),

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
                                ->hintIcon('s-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                                ->nullable(),
                            TextInput::make('phone')
                                ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                                ->label('Phone Number')
                                ->tel()
                                ->prefix('+234')
                                ->prefixIcon('s-phone')
                                ->placeholder('7059753934')
                                ->autocomplete()
                                ->required(),
                            TextInput::make('student.emergency_phone')
                                ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                                ->label('Emergency Contact Number')
                                ->tel()
                                ->prefixIcon('s-phone')
                                ->prefix('+234')
                                ->placeholder('7059753934')
                                ->autocomplete()
                                ->required(),
                            Select::make('student.guardian.user.id')
                                ->label('Guardian (Parent)')
                                ->options(User::query()->whereHas('roles', function (Builder $query) {
                                    $query->where('roles.id', Role::GUARDIAN);
                                })
                                    ->get(['id', 'first_name', 'middle_name', 'last_name'])
                                    ->pluck('full_name', 'id'))
                                ->disabled()
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
                                ->disabled()
                                ->required()
                                ->native(false),
                            Select::make('student.rhesus_factor')
                                ->label('Rhesus')
                                ->options([
                                    'Rh+' => 'Rh+',
                                    'Rh-' => 'Rh-',
                                ])
                                ->disabled()
                                ->required()
                                ->native(false),
                            Select::make('student.classroom.grade.id')
                                ->label('Grade')
                                ->options(Grade::all()->pluck('name', 'id'))
                                ->disabled()
                                ->required()
                                ->native(false),
                            Select::make('student.classroom_id')
                                ->label('Classroom')
                                ->options(fn (Get $get) => Classroom::query()
                                    ->where('grade_id', $get('student.classroom.grade.id'))
                                    ->get(['id', 'name'])
                                    ->pluck('name', 'id')
                                )
                                ->disabled()
                                ->required()
                                ->native(false),
                            Select::make('student.status')
                                ->options(\App\StudentStatus::class)
                                ->disabled()
                                ->required()
                                ->native(false),
                        ]),
                    Section::make('Security')
                        ->description('Change your password and profile picture here')
                        ->icon('s-shield-check')
                        ->schema([
                            FileUpload::make('avatar')
                                ->label('Passport')
                                ->image()
                                ->disabled()
                                ->deletable(false)
                                ->downloadable()
                                ->imageCropAspectRatio('1:1')
                                ->maxSize(1024)
                                ->disk('public')
                                ->directory('avatars'),

                            Actions::make([
                                Actions\Action::make('Change Password')
                                    ->icon('s-lock-closed')
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
                                                'password' => Hash::make($data['new_password']),
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
                                    }),
                            ])
                                ->alignCenter()
                                ->verticallyAlignCenter(),
                        ])
                        ->grow(false)
                        ->collapsible(),
                ]),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $data['phone'] = '+234'.$data['phone'];
        $data['student']['emergency_phone'] = '+234'.$data['student']['emergency_phone'];
        $data['student']['guardian_id'] = Guardian::query()->where('user_id', $data['student']['guardian']['user']['id'])->value('id');
        unset($data['student']['guardian']);

        $this->record->fill($data);
        $this->record->save();

        $this->record->student->fill($data['student']);
        $this->record->student->save();

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();
    }
}
