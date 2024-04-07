<?php

namespace App\Livewire\Admin;

use App\Models\Lga;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\State;
use App\Models\Country;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Tables\Table;
use Livewire\Attributes\Title;
use Illuminate\Support\Collection;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Model;

#[Title('Student')]
class Students extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->icon('c-document-plus')
                    ->label('New Student')
                    ->outlined()
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
                                    ->hintIcon('c-question-mark-circle', 'Valid email addresses only. This is the email address you\'ll use to sign in.')
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
                            ]),
                        Step::make('Contact & Location Info')
                            ->description('Residency & health data.')
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
                                TextInput::make('ecn')
                                    ->label('Emergency Contact Number')
                                    ->tel()
                                    ->prefixIcon('c-phone')
                                    ->prefix('+234')
                                    ->placeholder('7059753934'),
                                Select::make('blood_group')
                                    ->options(['A', 'B', 'AB', 'O'])
                                    ->required()
                                    ->native(false),
                                Select::make('rhesus')
                                    ->options(['Rh+', 'Rh-'])
                                    ->required()
                                    ->native(false),
                            ]),
                        Step::make('Account & Security Info')
                            ->description('Grade, passport, and password data.')
                            ->columns(2)
                            ->schema([
                                Select::make('grade')
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
                    // ->mutateFormDataUsing(function (array $data) {
                    //     $data['admission_number'] = ;
                    // })
                    ->using(function (array $data, string $model) {
                    })
            ])
            ->query(User::query()->whereHas('roles', function (Builder $query) {
                $query->where('roles.id', Role::STUDENT);
            }))
            ->columns([
                TextColumn::make('username'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
            ])
            ->emptyStateIcon('c-user-group')
            ->emptyStateHeading('No students')
            ->emptyStateDescription('Create a student to get started');;
    }

    public function generateAdmissionNumber(): string
    {
        return '';
    }
}
