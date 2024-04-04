<?php

namespace App\Livewire\Admin\Academics;

use App\AgeRange;
use App\Models\Grade;
use App\Models\Staff;
use App\Status;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
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
            ->headerActions([
                CreateAction::make()
                    ->icon('m-folder-plus')
                    ->label('Create grade')
                    ->outlined()
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
                                    ->autofocus()
                                    ->live(true),
                                DatePicker::make('start_date')
                                    ->label('Start Date')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false)
                                    ->live(true),
                                DatePicker::make('end_date')
                                    ->label('End Date')
                                    ->placeholder('Click to select a date')
                                    ->required()
                                    ->native(false)
                                    ->live(true),
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
                                    ->options(Status::class)
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
                        return $model::create($data);
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
                                        ->autofocus()
                                        ->live(true),
                                    DatePicker::make('start_date')
                                        ->label('Start Date')
                                        ->placeholder('Click to select a date')
                                        ->required()
                                        ->native(false)
                                        ->live(true),
                                    DatePicker::make('end_date')
                                        ->label('End Date')
                                        ->placeholder('Click to select a date')
                                        ->required()
                                        ->native(false)
                                        ->live(true),
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
                                        ->options(Status::class)
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
                TextColumn::make('name')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('staff.user.firstname')
                    ->label('Year Head')
                    ->placeholder('unassigned')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('subjects_count')
                    ->label('No. of Subjects')
                    ->counts('subjects')
                    ->alignCenter(),
                TextColumn::make('age_range')
                    ->label('Age Range')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('user.username')
                    ->label('Created by')
                    ->searchable()
                    ->alignCenter(),
                IconColumn::make('status')
                    ->icon(fn (Model $record): string => Status::from($record->status)->getIcon())
                    ->color(fn (Model $record): string => Status::from($record->status)->getColor())
                    ->tooltip(function (Model $record): string {
                        return Status::from($record->status)->getLabel();
                    })
                    ->alignCenter(),
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
            ->emptyStateDescription('Create a grade to get started');
    }
}
