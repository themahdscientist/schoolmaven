<?php

namespace App\Livewire\Guardian;

use App\Models\Lga;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Collection;

#[Title('Profile')]
class Profile extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public User $record;

    public function mount(): void
    {
        $this->record = User::query()->find(auth()->id());
        $this->form->fill($this->record->load('guardian')->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make('Personal Info')
                        ->description('Guardian bio-data.')
                        ->columns()
                        ->schema([
                            TextInput::make('username'),
                            TextInput::make('guardian.guardian_code')
                                ->label('Guardian Code')
                                ->disabled(),
                            TextInput::make('first_name')
                                ->label('First Name')
                                ->placeholder('Ifeanyichukwu')
                                ->disabled()
                                ->required()
                                ->maxLength(255)
                                ->minLength(2)
                                ->autocomplete(),
                            TextInput::make('middle_name')
                                ->label('Middle Name')
                                ->placeholder('Noel')
                                ->disabled()
                                ->autocomplete()
                                ->minLength(2)
                                ->maxLength(255),
                            TextInput::make('last_name')
                                ->label('Last Name')
                                ->placeholder('Akudinobi')
                                ->disabled()
                                ->autocomplete()
                                ->required()
                                ->minLength(2)
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->label('Email Address')
                                ->placeholder('tms@skoolmaven.com')
                                ->disabled()
                                ->autocomplete()
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
                                ->disabled()
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
                                ->disabled()
                                ->afterStateUpdated(fn (Set $set) => $set('lga_origin_id', null)),
                            Select::make('lga_origin_id')
                                ->label('LGA')
                                ->placeholder('Select an option')
                                ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin_id'))->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->native(false)
                                ->disabled(),
                            Select::make('guardian.marital_status')
                                ->label('Marital Status')
                                ->options(\App\MaritalStatus::class)
                                ->required()
                                ->native(false),
                            TextInput::make('guardian.occupation')
                                ->placeholder('Software Developer')
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
                                ->hintIcon('c-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                                ->nullable(),
                            TextInput::make('phone')
                                ->formatStateUsing(fn ($state) => Str::substr($state, 4))
                                ->tel()
                                ->label('Phone Number')
                                ->prefix('+234')
                                ->prefixIcon('c-phone')
                                ->placeholder('7059753934')
                                ->autocomplete()
                                ->required(),
                        ]),
                    Section::make('Security')
                        ->description('Change your password and profile picture here')
                        ->icon('c-shield-check')
                        ->schema([
                            FileUpload::make('avatar')
                                ->label('Profile Picture')
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
                        ->grow(false)
                        ->collapsible(),
                ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $data['phone'] = '+234' . $data['phone'];

        $this->record->fill($data);
        $this->record->save();

        $this->record->guardian->fill($data['guardian']);
        $this->record->guardian->save();

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();
    }
}
