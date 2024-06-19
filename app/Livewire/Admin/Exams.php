<?php

namespace App\Livewire\Admin;

use App\Models\Exam;
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
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Exams')]
class Exams extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Exams')
            ->description('Manage your exams here.')
            ->striped()
            ->headerActions([$this->examCreateAction()])
            ->actions([
                ActionGroup::make([
                    $this->examEditAction(),
                    DeleteAction::make(),
                ])
                    ->tooltip('Actions'),
            ], ActionsPosition::BeforeCells)
            ->query(Exam::query())
            ->columns([
                TextColumn::make('#')
                    ->label('S/N')
                    ->searchable(false)
                    ->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('notes')
                    ->placeholder('nothing to see here...'),
            ])
            ->emptyStateIcon('s-newspaper')
            ->emptyStateHeading('No exams')
            ->emptyStateDescription('Create a exam to get started')
            ->emptyStateActions([$this->examCreateAction()]);
    }

    public function examCreateAction(): Action
    {
        return CreateAction::make()
            ->icon('s-folder-plus')
            ->label('Create exam')
            ->modalWidth(MaxWidth::Medium)
            ->modalHeading('Exam registration')
            ->modalDescription('Create a new exam')
            ->createAnother(false)
            ->form([
                Select::make('period')
                    ->options(\App\Period::class)
                    ->searchable()
                    ->native(false)
                    ->required(),
                Select::make('session')
                    ->options(\App\Session::class)
                    ->searchable()
                    ->native(false)
                    ->required(),
                Textarea::make('notes')
                    ->placeholder('Type in here...'),
            ])
            ->model(Exam::class)
            ->mutateFormDataUsing(function (array $data) {
                $data['name'] = $data['period'].' '.$data['session'];
                unset($data['period'], $data['session']);

                return $data;
            })
            ->using(function (array $data, string $model): Model {
                return DB::transaction(function () use ($data, $model) {
                    return $model::query()->updateOrCreate([
                        'name' => $data['name'],
                    ], [
                        'notes' => $data['notes'],
                    ]);
                });
            })
            ->successNotificationTitle('Exam created');
    }

    public function examEditAction(): Action
    {
        return EditAction::make()
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Exams')
            ->modalDescription('You can view and edit exam information here')
            ->form([
                TextInput::make('name')
                    ->placeholder('FIRST TERM 2000-2001')
                    ->required()
                    ->disabled(),
                Textarea::make('notes')
                    ->placeholder('Type in here...')
                    ->autosize()
                    ->autofocus(),
            ]);
    }
}
