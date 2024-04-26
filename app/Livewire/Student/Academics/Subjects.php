<?php

namespace App\Livewire\Student\Academics;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Collection;

#[Title('Subjects')]
class Subjects extends Component
{
    public Collection $subjects;

    public function mount()
    {
        $this->subjects = User::find(auth()->id())->student->grade->subjects;
    }
}
