<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Grade;
use App\Models\Subject;
use Filament\Forms\Components\CheckboxList;
use Livewire\Component;
use Filament\Tables\Table;
use Livewire\Attributes\Title;
use Filament\Forms\Components\Grid;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Support\Facades\DB;

#[Title('Subjects')]
class Subjects extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

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
                    DeleteAction::make()
                ])
                    ->color('gray')
                    ->tooltip('Actions'),
            ])
            ->query(Subject::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description')
                    ->placeholder('no description'),
                TextColumn::make('type'),
                TextColumn::make('user.username')
                    ->label('Created by'),
            ])
            ->emptyStateIcon('c-rectangle-stack')
            ->emptyStateHeading('No subjects')
            ->emptyStateDescription('Create a subject to get started')
            ->emptyStateActions([$this->subjectCreateAction()]);
    }

    public function subjectCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('c-folder-plus')
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
            ->using(function (array $data, $model): Grade {
                return DB::transaction(function () use ($data, $model) {
                    $grades = $model::query()->findMany($data['grades']);
                    $subjects = Subject::query()->findMany($data['subjects']);

                    foreach ($grades as $grade) {
                        $grade->subjects()->syncWithoutDetaching($subjects);
                    }

                    return $grade;
                });
            })
            ->successNotificationTitle('Linkage success')
            ->successRedirectUrl(route('app.' . session('role') . '.academics.grades'));
    }
}
