<?php

namespace App\Livewire\Auth;

use App\Models\User;
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
        $this->roles = User::query()->find(auth()->id())->roles;
        $this->role = $this->roles->first()->name;
    }

    public function done()
    {
        session(['role' => $this->role]);

        return $this->redirectIntended(route('app.'.$this->role.'.dashboard'));
    }
}
