<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Grade;
use Filament\Forms\Components\Select;
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
                    ->modalWidth(MaxWidth::Medium)
                    ->modalHeading('Grade registration')
                    ->modalDescription('Create a new grade')
                    ->createAnother(false)
                    ->form([
                        TextInput::make('name')
                            ->label('Grade Name')
                            ->placeholder('Grade 1')
                            ->required()
                            ->maxLength(100)
                            ->minLength(4)
                            ->autocomplete()
                            ->autofocus()
                            ->live(true),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->required()
                            ->native(false)
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
                ActionGroup::make([
                    EditAction::make()
                        ->form([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Select::make('status')
                                ->required()
                                ->options([
                                    'active' => 'Active',
                                    'inactive' => 'Inactive'
                                ])
                                ->native(false),
                        ]),
                    DeleteAction::make()
                ])
                    ->color('info')
                    ->tooltip('Actions'),
            ])
            ->query(Grade::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('user.first_name')
                    ->label('Created by')
                    ->searchable()
                    ->alignCenter(),
                IconColumn::make('status')
                    ->icon(fn (string $state): string => match ($state) {
                        'active' => 'm-check-circle',
                        'inactive' => 'm-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    })
                    ->tooltip(function (Model $record): string {
                        if ($record->status == 'active') return 'Active';
                        else return 'Inactive';
                    })
                    ->alignCenter(),
            ])
            ->searchPlaceholder('Search (Name)')
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
