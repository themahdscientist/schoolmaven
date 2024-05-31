<?php

namespace App\Livewire\Staff\Academics;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Students')]
class Students extends Component
{
    public Collection $classrooms;

    public function mount()
    {
        $this->classrooms = User::query()->find(auth()->id())->staff->classrooms()->with(['students.user', 'grade'])->get();
    }
}
