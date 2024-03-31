<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.security')]
#[Title('Role Selection')]
class SelectRole extends Component
{
    public $roles;

    #[Validate('required|string|exists:roles,name')]
    public $role;

    public function mount()
    {
        $this->roles = auth()->user()->roles;
    }

    public function set()
    {
        session(['role' => $this->role]);

        return $this->redirectIntended(route('app.' . $this->role . '.dashboard'));
    }
}
