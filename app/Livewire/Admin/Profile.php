<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use App\Models\User;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
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
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Tabs::make()
                        ->tabs([
                            Tabs\Tab::make('Personal Information')
                                ->icon('c-user')
                                ->schema([
                                    Fieldset::make('Name')
                                        ->schema([
                                            TextInput::make('first_name')
                                                ->label('First Name')
                                                ->required()
                                                ->maxLength(255),
                                            TextInput::make('middle_name')
                                                ->label('Middle Name')
                                                ->required()
                                                ->maxLength(255),
                                            TextInput::make('last_name')
                                                ->label('Last Name')
                                                ->required()
                                                ->maxLength(255),
                                        ])
                                        ->columns(3),
                                    Fieldset::make('Credentials')
                                        ->schema([
                                            TextInput::make('username')
                                                ->required()
                                                ->maxLength(255),
                                            TextInput::make('email')
                                                ->email()
                                                ->required()
                                                ->maxLength(255),
                                        ]),
                                    Fieldset::make('Metadata')
                                        ->schema([
                                            Select::make('gender')
                                                ->required()
                                                ->options([
                                                    'male' => 'Male',
                                                    'female' => 'Female',
                                                    'other' => 'Other',
                                                ])
                                                ->native(false),
                                            Select::make('religion')
                                                ->required()
                                                ->options([
                                                    'christianity' => 'Christianity',
                                                    'islam' => 'Islam',
                                                    'other' => 'Other',
                                                ])
                                                ->native(false),
                                            TextInput::make('phone')
                                                ->tel()
                                                ->prefixIcon('c-phone')
                                                ->required(),
                                            DatePicker::make('dob')
                                                ->label('Date of Birth')
                                                ->native(false)
                                                ->required(),
                                            Select::make('country')
                                                ->label('Country of Residence')
                                                ->required()
                                                ->relationship('country', 'name')
                                                ->native(false),
                                            Select::make('state_residency')
                                                ->label('State of Residence')
                                                ->required()
                                                ->relationship('state', 'name')
                                                ->native(false),
                                            Select::make('lga_residency')
                                                ->label('City of Residence')
                                                ->required()
                                                ->relationship('lga', 'name')
                                                ->native(false),
                                        ]),
                                ]),
                            Tabs\Tab::make('School Information')
                                ->icon('c-building-library')
                                ->schema([
                                    Actions::make([
                                        Actions\Action::make('viewSchool')
                                            ->label('View School')
                                            ->icon('c-eye')
                                            ->iconSize(IconSize::Small)
                                            ->modalWidth(MaxWidth::Full)
                                            ->modalHeading('School Info')
                                            ->modalDescription('Some fields cannot be changed')
                                            ->modalSubmitActionLabel('Save')
                                            ->form([
                                                Split::make([
                                                    Section::make()
                                                        ->schema([
                                                            TextInput::make('name')
                                                                ->required()
                                                                ->maxLength(255),
                                                            TextInput::make('alias')
                                                                ->maxLength(255),
                                                            Select::make('accreditation')
                                                                ->required()
                                                                ->native(false)
                                                                ->options([
                                                                    'intl' => 'International',
                                                                    'ntl' => 'National',
                                                                    'rgl' => 'Regional',
                                                                ]),
                                                            KeyValue::make('info')
                                                                ->label('Contact Information')
                                                                ->addable(false)
                                                                ->deletable(false)
                                                                ->keyLabel('Methods')
                                                                ->editableKeys(false)
                                                                ->valueLabel('Value')
                                                                ->reorderable()
                                                                ->columnSpanFull(),
                                                            KeyValue::make('affiliation')
                                                                ->label('Exam Affiliates')
                                                                ->addable(false)
                                                                ->deletable(false)
                                                                ->keyLabel('Body')
                                                                ->editableKeys(false)
                                                                ->valueLabel('Value')
                                                                ->editableValues(false)
                                                                ->reorderable()
                                                                ->columnSpanFull(),
                                                            KeyValue::make('type')
                                                                ->label('Institution Type')
                                                                ->addable(false)
                                                                ->deletable(false)
                                                                ->keyLabel('Methods')
                                                                ->editableKeys(false)
                                                                ->valueLabel('Value')
                                                                ->editableValues(false)
                                                                ->reorderable()
                                                                ->columnSpanFull(),
                                                        ])
                                                        ->columns(3),
                                                    Section::make()
                                                        ->description('Additional Info')
                                                        ->schema([
                                                            Grid::make()
                                                                ->schema([
                                                                    TextInput::make('address')
                                                                        ->required()
                                                                        ->maxLength(255),
                                                                    Select::make('school_country')
                                                                        ->label('Country')
                                                                        ->relationship('country', 'name')
                                                                        ->options(null)
                                                                        ->default(Country::query()->find(1)->value('id'))
                                                                        ->disabled()
                                                                        ->native(false),
Select::make('school_state')
->label('State')
->relationship('state', 'name')
->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('school_country'))->pluck('name', 'id'))
->searchable()
->native(false)
->live(true)
->afterStateUpdated(fn (Set $set) => $set('school_lga', null)),
Select::make('school_lga')
->label('LGA')
->relationship('lga', 'name')
->options(fn (Get $get): Collection => Lga::query()->where('state_id', (int) $get('school_state'))->pluck('name', 'id'))
->searchable()
->native(false)
->live(true),
                                                                ]),
                                                            Grid::make()
                                                                ->schema([
                                                                    FileUpload::make('logo')
                                                                        ->image()
                                                                        ->imageEditor()
                                                                        ->maxSize(1024)
                                                                        ->disk('public')
                                                                        ->directory('logos')
                                                                        ->fetchFileInformation(false),
                                                                    TextInput::make('smil_code')
                                                                        ->label('SMIL Code')
                                                                        ->readOnly()
                                                                        ->required(),
                                                                ]),
                                                        ])
                                                        ->collapsible(),
                                                ])
                                                    ->from('md')
                                            ])
                                            ->fillForm(fn (User $record) => $record->load('school')->school->load(['country', 'state', 'lga'])->toArray())
                                            ->afterFormValidated(fn (array $data, User $record) => dd($data)),
                                    ])
                                        ->fullWidth(),
                                ]),
                            Tabs\Tab::make('Role Information')
                                ->icon('c-finger-print')
                                ->schema([
                                    Actions::make([
                                        Actions\Action::make('viewRoles')
                                            ->label('View Roles')
                                            ->icon('c-eye')
                                            ->iconSize(IconSize::Small)
                                            ->modalWidth(MaxWidth::Medium)
                                            ->modalHeading('Your Roles')
                                            ->modalDescription('Manage your system roles')
                                            ->modalSubmitActionLabel('Save')
                                            ->form([
                                                CheckboxList::make('roles')
                                                    ->relationship('roles', 'description')
                                                    ->required(),
                                            ])
                                    ])
                                        ->fullWidth(),
                                ]),
                        ]),
                    Section::make('Security')
                        ->description('Change your password and profile picture here')
                        ->icon('c-shield-check')
                        ->schema([
                            FileUpload::make('avatar')
                                ->label('Profile Picture')
                                ->image()
                                ->imageEditor()
                                ->maxSize(1024)
                                ->disk('public')
                                ->directory('avatars')
                                ->fetchFileInformation(false),
                            Grid::make()
                                ->schema([
                                    Select::make('nationality')
                                        ->label('Nationality')
                                        ->relationship('nationality', 'name')
                                        ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                                        ->default(Country::query()->find(1)->value('id'))
                                        ->disabled()
                                        ->required()
                                        ->native(false),
                                    Select::make('state_origin')
                                        ->label('State of Origin')
                                        ->relationship('stateOrigin', 'name')
                                        ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('nationality'))->pluck('name', 'id'))
                                        ->searchable()
                                        ->required()
                                        ->native(false)
                                        ->live(true)
                                        ->afterStateUpdated(fn (Set $set) => $set('lga_origin', null)),
                                    Select::make('lga_origin')
                                        ->label('LGA')
                                        ->relationship('lgaOrigin', 'name')
                                        ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin'))->pluck('name', 'id'))
                                        ->searchable()
                                        ->required()
                                        ->native(false)
                                        ->live(true),
                                    TextInput::make('postal_code')
                                        ->required()
                                        ->maxLength(10),
                                ]),
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
                                            ->body('On successful password update, you\'ll be redirected to the login page')
                                            ->info()
                                            ->send();
                                    })
                                    ->afterFormValidated(function (array $data, User $record) {
                                        if (Hash::check($data['password'], $record->password)) {
                                            $record->forceFill([
                                                'password' => Hash::make($data['new_password'])
                                            ]);
                                            $record->save();

                                            auth()->logout();
                                            request()->session()->invalidate();
                                            request()->session()->regenerateToken();

                                            Notification::make()
                                                ->title('Password Updated')
                                                ->body('You\'ve been redirected')
                                                ->success()
                                                ->send();

                                            return $this->redirectRoute('app.login', navigate: true);
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
                        ])
                        ->collapsible()
                        ->grow(false),
                ])
                    ->from('md')
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        Notification::make()
            ->title('Saved Successfully')
            ->success()
            ->send();
    }
}
