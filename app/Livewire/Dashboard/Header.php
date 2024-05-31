<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public User $user;

    public int $unreadNotificationsCount;

    #[On('refresh')]
    public function refresh(): void
    {
    }

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id())->load('school');
        $this->unreadNotificationsCount = $this->user->unreadNotifications->count();
    }
}
