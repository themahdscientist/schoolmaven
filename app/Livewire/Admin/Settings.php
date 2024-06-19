<?php

namespace App\Livewire\Admin;

use App\Models\School;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Settings')]
class Settings extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public School $record;

    public function mount(): void
    {
        $this->record = School::query()->find(auth()->id());
        $this->form->fill($this->record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->statePath('data')
        ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->fill($data);
        $this->record->save();

        $this->dispatch('refresh');

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();
    }
}
