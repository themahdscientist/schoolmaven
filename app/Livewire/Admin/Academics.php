<?php

namespace App\Livewire\Admin;

use App\Models\Grade;
use App\Models\User;
use Livewire\Component;
use Filament\Actions\Action;
use Livewire\Attributes\Title;
use Filament\Actions\CreateAction;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Model;

#[Title('Academics')]
class Academics extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public function grade(): Action
    {
        return CreateAction::make('grade')
            ->icon('m-folder-plus')
            ->label('Create grade')
            ->outlined()
            ->size(ActionSize::ExtraLarge)
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
            ->successNotificationTitle('Grade created');
    }

    // public function subject(): Action
    // {
    //     return CreateAction::make('subject')
    //         ->icon('m-plus')
    //         ->label('Create subject')
    //         ->outlined()
    //         ->size(ActionSize::ExtraLarge)
    //         ->modalWidth(MaxWidth::FitContent)
    //         ->modalHeading('Class registration')
    //         ->modalDescription('Create a new grade / class')
    //         ->createAnother(false)
    //         ->form([
    //             TextInput::make('name')
    //         ]);
    // }
}
