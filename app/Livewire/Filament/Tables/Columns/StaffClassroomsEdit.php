<?php

namespace App\Livewire\Filament\Tables\Columns;

use App\Models\Classroom;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use LivewireUI\Modal\ModalComponent;

class StaffClassroomsEdit extends ModalComponent
{
    public User $record;

    public Collection $classrooms;

    public array $staffClassrooms;

    public function mount($record)
    {
        $this->record = $record;
        $this->classrooms = Classroom::all();
        $this->staffClassrooms = $record->staff->classrooms->pluck('id')->toArray();

    }
    
    public function save()
    {
        $this->record->staff->classrooms()->sync($this->staffClassrooms);

        Notification::make()
            ->title('Saved')
            ->success()
            ->send();

        $this->closeModalWithEvents(['refreshTable']);
    }
}
