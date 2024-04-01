<?php

namespace App\Livewire\Admin\Academics;

use App\Models\Grade;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
            ->query(Grade::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('user.first_name')
                    ->label('Created by')
                    ->searchable(),
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
                    }),
            ])
            ->searchPlaceholder('Search (Name)')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ])
            ])
            ->emptyStateIcon('m-rectangle-stack')
            ->emptyStateHeading('No grades')
            ->emptyStateDescription('Create a grade to get started');
    }
}
