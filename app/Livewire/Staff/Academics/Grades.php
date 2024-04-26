<?php

namespace App\Livewire\Staff\Academics;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Grades')]
class Grades extends Component
{
    public Collection $grades;

    public function mount()
    {
        $this->grades = User::query()->find(auth()->id())->staff->grades()->with('subjects', 'staff.user')->get();
    }
}