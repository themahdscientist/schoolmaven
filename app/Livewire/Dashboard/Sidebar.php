<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::query()->findOrFail(auth()->id())->load('school');
    }

    public function grades()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.grades', navigate: true);
    }

    public function subjects()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.subjects', navigate: true);
    }

    public function students()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.students', navigate: true);
    }
}
