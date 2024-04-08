<?php

namespace App\Livewire\Admin;

use App\Models\Lga;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\State;
use App\Models\Country;
use App\Models\Student;
use Carbon\Carbon;
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
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Auth\Events\Registered;
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
                                Select::make('guardian_id')
                                    ->label('Guardian (Parent)')
                                    ->placeholder('Select a guardian')
                                    ->options(User::query()->whereHas('roles', function (Builder $query) {
                                        $query->where('roles.id', Role::GUARDIAN);
                                    })
                                        ->pluck('last_name', 'id'))
                                    ->searchable()
                                    ->nullable()
                                    ->native(false),
                                Select::make('blood_group')
                                    ->label('Blood Group')
                                    ->options([
                                        'A' => 'A',
                                        'B' => 'B',
                                        'AB' => 'AB',
                                        'O' => 'O',
                                    ])
                                    ->required()
                                    ->native(false),
                                Select::make('rhesus_factor')
                                    ->label('Rhesus')
                                    ->options([
                                        'Rh+' => 'Rh+',
                                        'Rh-' => 'Rh-',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),
                        Step::make('Account & Security Info')
                            ->description('Grade, passport, and password data.')
                            ->columns(2)
                            ->schema([
                                Select::make('grade_id')
                                    ->label('Grade')
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
                    ->mutateFormDataUsing(function (array $data, string $model) {
                        $date = Carbon::now()->year;
                        $school = $model::query()->find(auth()->id())->school;

                        $last_student = Student::query()->whereHas('user.school', function (Builder $query) use ($school) {
                            $query->where('id', $school->id);
                        })
                            ->latest('admission_number')
                            ->first();

                        $serial = $last_student ? intval(substr($last_student->admission_number, 6, 4)) + 1 : 1;
                        $serial = str_pad($serial, 4, '0', STR_PAD_LEFT);
                        $smil_code = $school->smil_code;
                        $code = substr($smil_code, 0, 4);
                        $first = substr($date, 0, 2);
                        $last = substr($date, -2);

                        $data['admission_number'] = $first . $code . $serial . $last;
                        return $data;
                    })
                    ->using(function (array $data, string $model): Model {
                        $user = new $model;
                        $user->school_id = $model::query()->find(auth()->id())->school->id;
                        $user->username = $this->generateUsername($data['first_name'], $data['last_name']);
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
                        $user->lga_id = $data['lga'];
                        $user->state_id = $data['state'];
                        $user->country_id = 1;
                        $user->lga_origin_id = $data['lga_origin'];
                        $user->state_origin_id = $data['state_origin'];
                        $user->nationality_id = 1;
                        $user->avatar = $data['avatar'];
                        $user->save();
                        $user->roles()->attach(Role::STUDENT);

                        // Student
                        $student = new Student;
                        $student->user_id = $user->id;
                        $student->guardian_id = $data['guardian_id'];
                        $student->grade_id = $data['grade_id'];
                        $student->admission_number = $data['admission_number'];
                        $student->blood_group = $data['blood_group'];
                        $student->rhesus_factor = $data['rhesus_factor'];
                        $student->emergency_phone = '+234' . $data['ecn'];
                        $student->save();

                        event(new Registered($user));

                        Notification::make()
                            ->title('Admission Success')
                            ->body('Student has been provisioned 🎉')
                            ->success()
                            ->send();

                        Notification::make()
                            ->title('Congratulations!')
                            ->body('You\ve been given provisional admission 🎉')
                            ->success()
                            ->sendToDatabase($user);

                        return $user;
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
            ->emptyStateDescription('Create a student to get started');
    }

    protected function generateUsername($u_fname, $u_lname): mixed
    {
        $date = Carbon::now()->year;
        $hour  = Carbon::now()->hour;
        $second  = Carbon::now()->second;
        return substr($date, 0, 2) . strtolower($u_fname . substr($u_lname, 0, 1) . substr($u_lname, -1, 1)) . substr($date, -2) . $hour . $second;
    }
}
