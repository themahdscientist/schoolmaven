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

    public function sections()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.sections', navigate: true);
    }

    public function classrooms()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.classrooms', navigate: true);
    }

    public function subjects()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.subjects', navigate: true);
    }

    public function timetables()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.timetables', navigate: true);
    }

    public function exams()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.exams', navigate: true);
    }

    public function schedules()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.schedules', navigate: true);
    }

    public function students()
    {
        return $this->redirectRoute('app.'.session('role').'.academics.students', navigate: true);
    }
}
