<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\RegisterForm;
use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Register')]
class Register extends Component
{
    use WithFileUploads;

    public RegisterForm $form;

    public $error;

    public function mount()
    {
        $this->form->countries = Country::where('id', 1)->get();
    }

    public function register()
    {
        $this->form->store();

        $this->redirectRoute('app.admin.dashboard');
    }

    public function updating()
    {
        $this->error = null;
    }

    public function updatedFormCountry($country)
    {
        $this->form->lga = null;
        $this->form->state = null;
        $this->form->states = State::where('country_id', $country)->get();
    }

    public function updatedFormState($state)
    {
        $this->form->lga = null;
        $this->form->lgas = Lga::where('state_id', $state)->get();
    }
}
