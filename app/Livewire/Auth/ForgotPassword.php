<?php

namespace App\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.security')]
#[Title('Forgot Password')]
class ForgotPassword extends Component
{
    use WithRateLimiting;

    public $status;

    #[Validate('required|email')]
    public $email;

    public function send()
    {
        $this->validate();

        try {
            $this->rateLimit(1);
        } catch (TooManyRequestsException $exception) {
            $this->status = "Too many email requests! Please wait another {$exception->secondsUntilAvailable} seconds before retrying.";
            throw ValidationException::withMessages([
                'email' => 'Attempts exceeded.',
            ]);
        }

        $this->status = Password::sendResetLink(['email' => $this->email]);

        $this->reset('email');
    }
}
