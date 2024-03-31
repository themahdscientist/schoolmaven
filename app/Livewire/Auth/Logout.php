<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    public $class;

    public function delete()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return $this->redirectRoute('app.login', navigate: true);
    }
}
