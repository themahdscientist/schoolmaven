<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $user;

    public function mount()
    {
        $this->user = auth()->user()->load('school');
        // $this->user = auth()->user()->load('roles:id,name');
    }

    public function grades()
    {
        return $this->redirectRoute('app.admin.academics.grades', navigate: true);
    }

    public function subjects()
    {
        return $this->redirectRoute('app.admin.academics.subjects', navigate: true);
    }
}
