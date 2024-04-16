<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Models\Lga;
use App\Models\Role;
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
use Filament\Notifications\Notification;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

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
            ->modalWidth(MaxWidth::ScreenMedium)
            ->closeModalByClickingAway(false)
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalHeading('Staff Admissions')
            ->modalDescription('Enroll a staff member')
            ->skippableSteps()
            ->steps([
                Step::make('Personal Info')
                    ->description('Staff bio-data.')
                    ->columns(3)
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
                        Select::make('marital')
                            ->label('Marital Status')
                            ->options([
                                'single' => 'Single',
                                'married' => 'Married',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
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
                            ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('nationality'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true)
                            ->afterStateUpdated(fn (Set $set) => $set('lga_origin', null)),
                        Select::make('lga_origin')
                            ->label('LGA')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get) => Lga::query()->where('state_id', (int) $get('state_origin'))->pluck('name', 'id'))
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
                            ->hintIcon('c-exclamation-circle', 'Images and PDF documents are currently supported.')
                            ->hintColor('danger')
                            ->maxSize(1024)
                            ->maxFiles(3)
                            ->disk('public')
                            ->directory('qualifications'),
                            Select::make('contract_type')
                            ->label('Contract Type')
                            ->options(\App\ContractType::class)
                            ->required()
                            ->native(false),
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
                        Select::make('country')
                            ->label('Country of Residence')
                            ->placeholder('Select an option')
                            ->options(Country::query()->where('id', '1')->pluck('name', 'id'))
                            ->default(Country::query()->find(1)->value('id'))
                            ->disabled()
                            ->required()
                            ->native(false),
                        Select::make('state')
                            ->label('State of Residence')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get): Collection => State::query()->where('country_id', (int) $get('country'))->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->live(true)
                            ->afterStateUpdated(fn (Set $set) => $set('lga', null)),
                        Select::make('lga')
                            ->label('City of Residence')
                            ->placeholder('Select an option')
                            ->options(fn (Get $get): Collection => Lga::query()->where('state_id', (int) $get('state'))->pluck('name', 'id'))
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
                            ->revealable(),

                    ]),
            ])
            ->model(User::class)
            ->successNotification(
                Notification::make()
                    ->title('Admission Success')
                    ->body('Staff member has been provisioned 🎉')
                    ->success()
            );
    }
}
