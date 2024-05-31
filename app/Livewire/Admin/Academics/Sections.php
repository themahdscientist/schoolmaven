<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Section;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sections')]
class Sections extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Sections')
            ->description('Manage your sections here.')
            ->striped()
            ->headerActions([$this->sectionCreateAction()])
            ->actions([
                ActionGroup::make([
                    $this->sectionEditAction(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
            ], ActionsPosition::BeforeCells)
            ->query(Section::query())
            ->columns([
                TextColumn::make('#')
                    ->label('S/N')
                    ->searchable(false)
                    ->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('description')
                    ->placeholder('nothing to see here...'),
                TextColumn::make('user.full_name')
                    ->searchable(['first_name', 'middle_name', 'last_name'])
                    ->label('Created by'),
                IconColumn::make('status')
                    ->icon(fn (Section $record): string => \App\Status::from($record->status)->getIcon())
                    ->color(fn (Section $record): string => \App\Status::from($record->status)->getColor())
                    ->tooltip(fn (Section $record): string => \App\Status::from($record->status)->getLabel()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(\App\Status::class)
                    ->native(false)
                    ->placeholder('Select an option'),
            ])
            ->emptyStateIcon('s-view-columns')
            ->emptyStateHeading('No sections')
            ->emptyStateDescription('Create a section to get started')
            ->emptyStateActions([$this->sectionCreateAction()]);
    }

    public function sectionCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('s-folder-plus')
            ->label('Create section')
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Section registration')
            ->modalDescription('Create a new section')
            ->createAnother(false)
            ->form([
                TextInput::make('name')
                    ->placeholder('A')
                    ->required()
                    ->maxLength(25)
                    ->minLength(1)
                    ->autocomplete()
                    ->autofocus(),
                Select::make('status')
                    ->options(\App\Status::class)
                    ->placeholder('Select an option')
                    ->required()
                    ->native(false),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ])
            ->model(Section::class)
            ->mutateFormDataUsing(function (array $data) {
                $data['user_id'] = auth()->id();

                return $data;
            })
            ->using(function (array $data, string $model): Model {
                return DB::transaction(function () use ($data, $model) {
                    return $model::create($data);
                });
            })
            ->successNotificationTitle('Section created');
    }

    public function sectionEditAction(): Action
    {
        return EditAction::make()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Sections')
            ->modalDescription('You can view and edit section information here')
            ->form([
                TextInput::make('name')
                    ->placeholder('A')
                    ->required()
                    ->maxLength(25)
                    ->minLength(1)
                    ->autocomplete()
                    ->autofocus(),
                Select::make('status')
                    ->options(\App\Status::class)
                    ->placeholder('Select an option')
                    ->required()
                    ->native(false),
                Textarea::make('description')
                    ->placeholder('Type in here...')
                    ->autosize(),
            ]);
    }
}
