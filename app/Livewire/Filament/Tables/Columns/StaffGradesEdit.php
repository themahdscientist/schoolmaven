<?php

namespace App\Livewire\Filament\Tables\Columns;

use App\Models\Grade;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use LivewireUI\Modal\ModalComponent;

class StaffGradesEdit extends ModalComponent
{
    public User $record;

    public Collection $grades;

    public array $staffGrades;

    public function mount($record)
    {
        $this->record = $record;
        $this->grades = Grade::all();
        $this->staffGrades = $record->staff->grades->pluck('id')->toArray();
    }

    public function save()
    {
        $this->record->staff->grades()->sync($this->staffGrades);

        $this->dispatch('refreshTable');

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();

        $this->closeModal();
    }
}
