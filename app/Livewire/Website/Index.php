<?php

namespace App\Livewire\Website;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.main')]
#[Title('Streamline for Success')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.website.index');
    }
}
