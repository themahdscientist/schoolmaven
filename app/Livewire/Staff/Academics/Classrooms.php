<?php

namespace App\Livewire\Staff\Academics;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Classrooms')]
class Classrooms extends Component
{
    public Collection $classrooms;

    public function mount()
    {
        $this->classrooms = User::query()->find(auth()->id())->staff->classrooms()->with(['subjects', 'grade.staff.user', 'formTeacher.user'])->get();
    }
}
