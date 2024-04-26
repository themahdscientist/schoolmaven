<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Grade;
use App\Models\Subject;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Subjects')]
class Subjects extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Subjects')
            ->description('Manage your subjects (courses) here.')
            ->striped()
            ->headerActions([
                $this->gradeSubjectLink(),
                $this->subjectCreateAction(),
            ])
            ->actions([
                ActionGroup::make([
                    $this->subjectEditAction(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
            ])
            ->query(Subject::query())
            ->columns([
                TextColumn::make('#')
                    ->label('S/N')
                    ->searchable(false)
                    ->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('description')
                    ->placeholder('no description'),
                TextColumn::make('type'),
                TextColumn::make('user.full_name')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->label('Created by'),
            ])
            ->emptyStateIcon('s-rectangle-stack')
            ->emptyStateHeading('No subjects')
            ->emptyStateDescription('Create a subject to get started')
            ->emptyStateActions([$this->subjectCreateAction()]);
    }

    public function subjectCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('s-folder-plus')
            ->label('Create subject')
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Subject registration')
            ->modalDescription('Create a new subject')
            ->createAnother(false)
            ->form([
                Grid::make()
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Mathematics')
                            ->required()
                            ->maxLength(100)
                            ->minLength(1)
                            ->autocomplete()
                            ->autofocus(),
                        Select::make('type')
                            ->placeholder('Select an option')
                            ->options([
                                'theory' => 'Theory',
                                'practical' => 'Practical',
                                'combined' => 'Combined',
                            ])
                            ->required()
                            ->native(false),
                    ]),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ])
            ->model(Subject::class)
            ->mutateFormDataUsing(function (array $data) {
                $data['user_id'] = auth()->id();

                return $data;
            })
            ->using(function (array $data, string $model): Model {
                return DB::transaction(function () use ($data, $model) {
                    return $model::create($data);
                });
            })
            ->successNotificationTitle('Subject created');
    }

    public function subjectEditAction(): Action
    {
        return EditAction::make()
            ->form([
                Grid::make()
                    ->schema([
                        TextInput::make('name')
                            ->placeholder('Mathematics')
                            ->required()
                            ->maxLength(100)
                            ->minLength(1)
                            ->autocomplete()
                            ->autofocus(),
                        Select::make('type')
                            ->placeholder('Select an option')
                            ->options([
                                'theory' => 'Theory',
                                'practical' => 'Practical',
                                'combined' => 'Combined',
                            ])
                            ->required()
                            ->native(false),
                    ]),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ]);
    }

    public function gradeSubjectLink(): Action
    {
        return CreateAction::make('grade_subject')
            ->icon('s-link')
            ->label('Link a grade')
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Grade Subject Linking')
            ->modalDescription('Link a grade to a subject')
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
            ->using(function (array $data, $model): Grade {
                return DB::transaction(function () use ($data, $model) {
                    $grades = $model::query()->findMany($data['grades']);
                    $subjects = Subject::query()->findMany($data['subjects']);

                    $grades->each(function (Grade $grade) use ($subjects) {
                        $grade->subjects()->syncWithoutDetaching($subjects);
                    });

                    return $grades->first();
                });
            })
            ->successNotificationTitle('Linkage success')
            ->successRedirectUrl(route('app.'.session('role').'.academics.grades'));
    }
}
