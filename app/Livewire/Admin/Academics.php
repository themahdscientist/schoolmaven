<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Filament\Actions\Action;
use Livewire\Attributes\Title;
use Filament\Actions\CreateAction;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\MaxWidth;

#[Title('Academics')]
class Academics extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;


    public function grade(): Action
    {
        return CreateAction::make('grade')
            ->icon('m-plus')
            ->label('Create class')
            ->modalWidth(MaxWidth::FitContent)
            ->modalHeading('Class registration')
            ->modalDescription('Create a new grade / class')
            ->createAnother(false)
            ->form([
                TextInput::make('name')
            ]);
    }
}
