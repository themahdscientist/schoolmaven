<?php

namespace App\Livewire\Staff;

use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
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
        $this->form->fill($this->record->load('staff')->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make('Personal Info')
                        ->description('Staff bio-data.')
                        ->columns(2)
                        ->schema([
                            TextInput::make('username'),
                            Select::make('staff.position_title')
                                ->label('Position Title')
                                ->options(\App\PositionTitle::class)
                                ->required()
                                ->native(false),
                            TextInput::make('first_name')
                                ->label('First Name')
                                ->disabled()
                                ->placeholder('Ifeanyichukwu')
                                ->required()
                                ->maxLength(255)
                                ->minLength(2)
                                ->autocomplete()
                                ->autofocus(),
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
                                ->disabled()
                                ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('nationality_id'))->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->native(false)
                                ->live(true)
                                ->afterStateUpdated(fn (Set $set) => $set('lga_origin_id', null)),
                            Select::make('lga_origin_id')
                                ->label('LGA')
                                ->placeholder('Select an option')
                                ->disabled()
                                ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin_id'))->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->native(false)
                                ->live(true),
                            TextInput::make('staff.bank_details.bank_account_number')
                                ->numeric()
                                ->disabled()
                                ->label('Account Number')
                                ->placeholder('2034127047')
                                ->required(),
                            TextInput::make('staff.bank_details.bank_account_name')
                                ->disabled()
                                ->label('Account Name')
                                ->placeholder('Emmanuel Akudinobi')
                                ->required(),
                            TextInput::make('staff.bank_details.bank_name')
                                ->label('Bank Name')
                                ->disabled()
                                ->placeholder('FirstBank of Nigeria')
                                ->required(),
                            TextInput::make('staff.salary')
                                ->disabled()
                                ->numeric()
                                ->prefix(new HtmlString('<strong>NGN</strong>'))
                                ->placeholder('150000')
                                ->required(),
                            TextInput::make('staff.staff_code')
                                ->disabled()
                                ->label('Staff Code')
                                ->required(),
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
                            Select::make('staff.contract_type')
                                ->label('Contract Type')
                                ->options(\App\ContractType::class)
                                ->disabled()
                                ->required()
                                ->native(false),
                            TextInput::make('phone')
                                ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                                ->tel()
                                ->label('Phone Number')
                                ->prefix('+234')
                                ->prefixIcon('s-phone')
                                ->placeholder('7059753934')
                                ->autocomplete()
                                ->required(),
                            TextInput::make('staff.emergency_phone')
                                ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                                ->label('Emergency Contact Number')
                                ->tel()
                                ->prefixIcon('s-phone')
                                ->prefix('+234')
                                ->placeholder('7059753934'),

                        ]),
                    Section::make('Security')
                        ->description('Change your password and profile picture here')
                        ->icon('s-shield-check')
                        ->schema([
                            FileUpload::make('avatar')
                                ->label('Profile Picture')
                                ->disabled()
                                ->image()
                                ->deletable(false)
                                ->downloadable()
                                ->imageCropAspectRatio('1:1')
                                ->maxSize(1024)
                                ->disk('public')
                                ->directory('avatars'),
                            Grid::make(1)
                                ->schema([
                                    FileUpload::make('staff.qualifications')
                                        ->hint(new HtmlString('Maximum of <strong>3</strong> documents'))
                                        ->hintIcon('s-exclamation-circle', 'Images and PDF documents are currently supported.')
                                        ->label('Qualifications')
                                        ->disabled()
                                        ->multiple()
                                        ->panelLayout('compact')
                                        ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg'])
                                        ->appendFiles()
                                        ->deletable(false)
                                        ->downloadable()
                                        ->maxSize(1024)
                                        ->maxFiles(3)
                                        ->disk('public')
                                        ->directory('qualifications'),
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
                                                    ->body('On successful password update, every session logged in with this guardian will expire.')
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
                                ->columnSpan(1),

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
        $data['staff']['emergency_phone'] = '+234'.$data['staff']['emergency_phone'];

        $this->record->fill($data);
        $this->record->save();

        $this->record->staff->fill($data['staff']);
        $this->record->staff->save();

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();
    }
}
