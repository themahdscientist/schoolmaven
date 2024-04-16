<?php

namespace App\Livewire\Admin\Academics;

use App\AgeRange;
use App\Models\Grade;
use App\Models\Staff;
use App\Models\Subject;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Grades')]
class Grades extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->striped()
            ->headerActions([
                CreateAction::make('grade_subject')
                    ->icon('c-link')
                    ->label('Link a subject')
                    ->modalWidth(MaxWidth::Medium)
                    ->modalHeading('Grade Subject Linking')
                    ->modalDescription('Link a subject to a grade')
                    ->modalSubmitActionLabel('Link')
                    ->createAnother(false)
                    ->form([
                        Select::make('grades')
                            ->options(Grade::all()->pluck('name', 'id'))
                            ->multiple()
                            ->required()
                            ->searchable()
                            ->native(false),
                        CheckboxList::make('subjects')
                            ->options(Subject::all()->pluck('name', 'id'))
                            ->required()
                            ->columns()
                            ->searchable()
                            ->bulkToggleable(),
                    ])
                    ->model(Grade::class)
                    ->using(function (array $data, $model) {
                        DB::transaction(function () use ($data, $model) {
                            $grades = $model::query()->findMany($data['grades']);
                            $subjects = Subject::query()->findMany($data['subjects']);

                            foreach ($grades as $grade) {
                                $grade->subjects()->syncWithoutDetaching($subjects);
                            }
                        });
                    })
                    ->successNotificationTitle('Linkage success'),
                CreateAction::make()
                    ->icon('m-folder-plus')
                    ->label('Create grade')
                    ->modalWidth(MaxWidth::ScreenMedium)
                    ->modalHeading('Grade registration')
                    ->modalDescription('Create a new grade')
                    ->createAnother(false)
                    ->form([
                        Grid::make([
                            'md' => 3
                        ])
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Grade 1')
                                    ->required()
                                    ->maxLength(100)
                                    ->minLength(1)
                                    ->autocomplete()
                                    ->autofocus(),
                                DatePicker::make('start_date')
                                    ->label('Start Date')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false),
                                DatePicker::make('end_date')
                                    ->label('End Date')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false),
                            ]),
                        Fieldset::make('Grade Metadata')
                            ->columns(3)
                            ->schema([
                                Select::make('year_head_id')
                                    ->label('Year Head')
                                    ->placeholder('Select a staff')
                                    ->options(Staff::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false),
                                Select::make('age_range')
                                    ->label('Age Range')
                                    ->placeholder('Select an Age Range')
                                    ->options(AgeRange::class)
                                    ->required()
                                    ->native(false),
                                Select::make('status')
                                    ->placeholder('Select an option')
                                    ->options(\App\Status::class)
                                    ->required()
                                    ->native(false),
                            ]),
                        Textarea::make('description')
                            ->placeholder('Type in here...')
                            ->autosize(),
                    ])
                    ->model(Grade::class)
                    ->mutateFormDataUsing(function (array $data) {
                        $data['user_id'] = auth()->id();
                        return $data;
                    })
                    ->using(function (array $data, string $model): Model {
                        return DB::transaction(function () use ($data, $model) {
                            return $model::create($data);
                        });
                    })
                    ->successNotificationTitle('Grade created')
            ])
            ->actions([
                EditAction::make('subjects')
                    ->label('Subjects')
                    ->icon('c-newspaper')
                    ->color('gray')
                    ->button()
                    ->modalWidth(MaxWidth::FitContent)
                    ->modalHeading('Subjects')
                    ->modalDescription('You can view and assign subjects to a grade')
                    ->modalSubmitActionLabel('Update')
                    ->form([
                        CheckboxList::make('subjects')
                            ->label('Subjects offered')
                            ->columns(3)
                            ->relationship('subjects', 'name'),
                    ]),
                ActionGroup::make([
                    EditAction::make()
                        ->modalWidth(MaxWidth::FitContent)
                        ->modalHeading('Grades')
                        ->modalDescription('You can view and edit grade information here')
                        ->form([
                            Grid::make([
                                'md' => 3
                            ])
                                ->schema([
                                    TextInput::make('name')
                                        ->placeholder('Grade 1')
                                        ->required()
                                        ->maxLength(100)
                                        ->minLength(4)
                                        ->autocomplete()
                                        ->autofocus(),
                                    DatePicker::make('start_date')
                                        ->label('Start Date')
                                        ->placeholder('Click to select a date')
                                        ->required()
                                        ->native(false),
                                    DatePicker::make('end_date')
                                        ->label('End Date')
                                        ->placeholder('Click to select a date')
                                        ->required()
                                        ->native(false),
                                ]),
                            Fieldset::make('Grade Metadata')
                                ->columns(3)
                                ->schema([
                                    // ! come and fix this!
                                    // Select::make('year_head_id')
                                    //     ->label('Year Head')
                                    //     ->relationship('staff', 'name')
                                    //     ->options(Staff::all()->pluck('name', 'id'))
                                    //     ->searchable()
                                    //     ->native(false),
                                    Select::make('age_range')
                                        ->label('Age Range')
                                        ->placeholder('Select an Age Range')
                                        ->options(AgeRange::class)
                                        ->required()
                                        ->native(false),
                                    Select::make('status')
                                        ->placeholder('Select an option')
                                        ->options(\App\Status::class)
                                        ->required()
                                        ->native(false),
                                ]),
                            CheckboxList::make('subjects')
                                ->label('Subjects offered')
                                ->columns(3)
                                ->relationship('subjects', 'name'),
                            Textarea::make('description')
                                ->placeholder('Type in here...')
                                ->autosize(),
                        ]),
                    DeleteAction::make()
                ])
                    ->color('gray')
                    ->tooltip('Actions'),
            ])
            ->query(Grade::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('staff.user.first_name')
                    ->label('Year Head')
                    ->placeholder('unassigned'),
                TextColumn::make('subjects_count')
                    ->label('No. of Subjects')
                    ->counts('subjects'),
                TextColumn::make('age_range')
                    ->label('Age Range'),
                TextColumn::make('user.username')
                    ->label('Created by'),
                IconColumn::make('status')
                    ->icon(fn (Model $record): string => \App\Status::from($record->status)->getIcon())
                    ->color(fn (Model $record): string => \App\Status::from($record->status)->getColor())
                    ->tooltip(fn (Model $record): string => \App\Status::from($record->status)->getLabel()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ])
                    ->native(false)
                    ->placeholder('Select an option')
            ])
            ->emptyStateIcon('m-rectangle-stack')
            ->emptyStateHeading('No grades')
            ->emptyStateDescription('Create a grade to get started')
            ->emptyStateActions([
                CreateAction::make()
                    ->icon('m-folder-plus')
                    ->label('Create grade')
                    ->size(ActionSize::Large)
                    ->modalWidth(MaxWidth::ScreenMedium)
                    ->modalHeading('Grade registration')
                    ->modalDescription('Create a new grade')
                    ->createAnother(false)
                    ->form([
                        Grid::make([
                            'md' => 3
                        ])
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Grade 1')
                                    ->required()
                                    ->maxLength(100)
                                    ->minLength(1)
                                    ->autocomplete()
                                    ->autofocus(),
                                DatePicker::make('start_date')
                                    ->label('Start Date')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false),
                                DatePicker::make('end_date')
                                    ->label('End Date')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false),
                            ]),
                        Fieldset::make('Grade Metadata')
                            ->columns(3)
                            ->schema([
                                Select::make('year_head_id')
                                    ->label('Year Head')
                                    ->placeholder('Select a staff')
                                    ->options(Staff::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false),
                                Select::make('age_range')
                                    ->label('Age Range')
                                    ->placeholder('Select an Age Range')
                                    ->options(AgeRange::class)
                                    ->required()
                                    ->native(false),
                                Select::make('status')
                                    ->placeholder('Select an option')
                                    ->options(\App\Status::class)
                                    ->required()
                                    ->native(false),
                            ]),
                        Textarea::make('description')
                            ->placeholder('Type in here...')
                            ->autosize(),
                    ])
                    ->model(Grade::class)
                    ->mutateFormDataUsing(function (array $data) {
                        $data['user_id'] = auth()->id();
                        return $data;
                    })
                    ->using(function (array $data, string $model): Model {
                        return DB::transaction(function () use ($data, $model) {
                            return $model::create($data);
                        });
                    })
                    ->successNotificationTitle('Grade created')
            ]);
    }
}
