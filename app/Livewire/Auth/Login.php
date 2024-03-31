<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Rules\IdentityExists;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

#[Title('Login')]
class Login extends Component
{
    use WithRateLimiting;

    public $error;

    #[Validate(['required', 'string', new IdentityExists])]
    public $identity = '';

    #[Validate(['required', 'string'])]
    public $password = '';

    #[Validate('sometimes')]
    public $remember = null;

    public function login()
    {
        $this->validate();
        
        try {
            $this->rateLimit(2, 30);
        } catch (TooManyRequestsException $exception) {
            $this->error = "Too many failed login attempts! Please wait another {$exception->secondsUntilAvailable} seconds before retrying.";
            throw ValidationException::withMessages([
                'identity' => "Cross-check your login credentials."
            ]);
        }
        
        $identity = filter_var($this->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$identity => $this->identity, 'password' => $this->password], $this->remember)) {
            $this->reset();

            session()->regenerate();
            if (Auth::user()->roles->count() == 1) {
                session(['role' => Auth::user()->roles->first()->name]);
            }
            return $this->redirectRoute('app.' . Auth::user()->roles->first()->name . '.dashboard', navigate: true);
        }

        $this->error = 'Invalid credentials';
    }

    public function updating()
    {
        $this->error = null;
    }
}
