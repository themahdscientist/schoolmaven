<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Staff')]
class Staff extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $user;

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id())->with('school')->first();
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->icon('m-plus')
                    ->label('New Staff')
                    ->modalWidth(MaxWidth::FitContent)
                    ->closeModalByClickingAway(false)
                    ->stickyModalHeader(true)
                    ->modalHeading('Staff Registration')
                    ->modalDescription('Create a staff member')
                    ->skippableSteps()
                    ->steps([
                        Step::make('Personal Info')
                            ->description('Staff bio-data.')
                            ->columns(2)
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('First Name')
                                    ->placeholder('Ifeanyichukwu')
                                    ->required()
                                    ->maxLength(255)
                                    ->minLength(2)
                                    ->autocomplete()
                                    ->autofocus()
                                    ->live(true),
                                TextInput::make('middle_name')
                                    ->label('Middle Name')
                                    ->autocomplete()
                                    ->minLength(2)
                                    ->placeholder('Noel')
                                    ->maxLength(255)
                                    ->live(true),
                                TextInput::make('last_name')
                                    ->label('Last Name')
                                    ->autocomplete()
                                    ->placeholder('Akudinobi')
                                    ->required()
                                    ->minLength(2)
                                    ->maxLength(255)
                                    ->live(true),
                                TextInput::make('email')
                                    ->email()
                                    ->label('Email Address')
                                    ->autocomplete()
                                    ->placeholder('tms@skoolmaven.com')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique('users', 'email')
                                    ->hintIcon('m-question-mark-circle', 'Valid email addresses only. This is the email address you\'ll use to sign in.')
                                    ->live(true),
                                Select::make('gender')
                                    ->label('Gender')
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                        'other' => 'Other',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                DatePicker::make('dob')
                                    ->label('Date of Birth')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                Select::make('religion')
                                    ->label('Religion')
                                    ->options([
                                        'christianity' => 'Christianity',
                                        'islam' => 'Islam',
                                        'other' => 'Other',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                Select::make('marital')
                                    ->label('Marital Status')
                                    ->options([
                                        'single' => 'Single',
                                        'married' => 'Married',
                                        'other' => 'Other',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                Select::make('nationality')
                                    ->label('Nationality')
                                    ->placeholder('Select an option')
                                    ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                                    ->default(Country::query()->find(1)->value('id'))
                                    ->disabled()
                                    ->required()
                                    ->native(false),
                                Select::make('state_origin')
                                    ->label('State of Origin')
                                    ->placeholder('Select an option')
                                    ->options(fn (Get $get): Collection => State::query()->where('country_id', $get('country'))->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->native(false)
                                    ->live(true)
                                    ->afterStateUpdated(fn (Set $set) => $set('lga', null)),
                                Select::make('lga_origin')
                                    ->label('LGA of Origin')
                                    ->placeholder('Select an option')
                                    ->options(fn (Get $get) => Lga::query()->where('state_id', $get('state'))->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                FileUpload::make('qualifications')
                                    ->label('Qualifications')
                                    ->multiple()
                                    ->panelLayout('compact')
                                    ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg'])
                                    ->appendFiles()
                                    ->previewable(false)
                                    ->hintIcon('m-exclamation-circle', 'Images and PDF documents are currently supported.')
                                    ->hintColor('danger')
                                    ->maxSize(1024)
                                    ->maxFiles(3)
                                    ->disk('public')
                            ]),
                        Step::make('Contact & Security Info')
                            ->description('Residency & security data.')
                            ->columns(2)
                            ->schema([
                                TextInput::make('address')
                                    ->label('Address')
                                    ->autocomplete()
                                    ->placeholder('No. 1 Ekwema Crescent, Ikenegbu')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(true),
                                Select::make('country')
                                    ->label('Country')
                                    ->placeholder('Select an option')
                                    ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                                    ->default(Country::query()->find(1)->value('id'))
                                    ->disabled()
                                    ->required()
                                    ->native(false),
                                Select::make('state')
                                    ->label('State')
                                    ->placeholder('Select an option')
                                    ->options(fn (Get $get): Collection => State::query()->where('country_id', $get('country'))->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->native(false)
                                    ->live(true)
                                    ->afterStateUpdated(fn (Set $set) => $set('lga', null)),
                                Select::make('lga')
                                    ->label('LGA')
                                    ->placeholder('Select an option')
                                    ->options(fn (Get $get) => Lga::query()->where('state_id', $get('state'))->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                TextInput::make('postal_code')
                                    ->label('Postal Code')
                                    ->placeholder('460242')
                                    ->autocomplete()
                                    ->hintIcon('m-question-mark-circle', 'This can be the school\'s P.M.B. (Private Mail Box)')
                                    ->nullable(),
                                TextInput::make('phone')
                                    ->tel()
                                    ->label('Phone Number')
                                    ->prefix('+234')
                                    ->prefixIcon('m-phone')
                                    ->placeholder('7059753934')
                                    ->autocomplete()
                                    ->required(),
                                TextInput::make('bank_account_number')
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
                                TextInput::make('password')
                                    ->label('Password')
                                    ->placeholder('********')
                                    ->required()
                                    ->password()
                                    ->revealable()

                            ]),
                    ])
            ])
            ->query(User::query()->whereHas('roles', function ($query) {
                $query->where('name', 'staff');
            }))
            ->columns([
                TextColumn::make('username'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
            ])
            ->emptyStateIcon('m-users')
            ->emptyStateHeading('No staff')
            ->emptyStateDescription('Create a staff member to get started');
    }
}
