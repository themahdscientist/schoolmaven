<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id())->with('school')->first();
    }

    public function grades()
    {
        return $this->redirectRoute('app.admin.academics.grades', navigate: true);
    }
}
