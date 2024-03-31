<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id())->with('school')->first();
    }
}
