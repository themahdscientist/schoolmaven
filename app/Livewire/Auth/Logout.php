<?php

namespace App\Livewire\Auth;

use Filament\Notifications\Notification;
use Livewire\Component;

class Logout extends Component
{
    public $class;

    public function delete()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        Notification::make()
            ->title('Logout Success')
            ->body('See ya!')
            ->success()
            ->send();

        return $this->redirectRoute('app.login', navigate: true);
    }
}
