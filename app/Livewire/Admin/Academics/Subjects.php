<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Subject;
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
use Filament\Tables\Concerns\InteractsWithTable;

#[Title('Subjects')]
class Subjects extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->icon('c-folder-plus')
                    ->label('Create subject')
                    ->outlined()
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
                                    ->autofocus()
                                    ->live(true),
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
                        return $model::create($data);
                    })
                    ->successNotificationTitle('Subject created')
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form([
                            Grid::make()
                                ->schema([
                                    TextInput::make('name')
                                        ->placeholder('Mathematics')
                                        ->required()
                                        ->maxLength(100)
                                        ->minLength(1)
                                        ->autocomplete()
                                        ->autofocus()
                                        ->live(true),
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
                        ]),
                    DeleteAction::make()
                ])
                    ->color('gray')
                    ->tooltip('Actions'),
            ])
            ->query(Subject::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('description')
                    ->placeholder('no description')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('type')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('user.username')
                    ->label('Created by')
                    ->searchable()
                    ->alignCenter(),
            ])
            ->emptyStateIcon('c-rectangle-stack')
            ->emptyStateHeading('No subjects')
            ->emptyStateDescription('Create a subject to get started');
    }
}
