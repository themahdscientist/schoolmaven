<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

#[Layout('components.layouts.security')]
#[Title('Reset Password')]
class ResetPassword extends Component
{
    use WithRateLimiting;

    public $status;

    #[Validate('required')]
    public $token;

    #[Validate('required|email|exists:users,email')]
    public $email;

    #[Validate('required|string|confirmed')]
    public $password;

    #[Validate('required|string', as: 'password')]
    public $password_confirmation;

    public function update()
    {
        $this->validate();
        
        try {
            $this->rateLimit(1);
        } catch (TooManyRequestsException $exception) {
            $this->status = "Too many reset requests! Please wait another {$exception->secondsUntilAvailable} seconds before retrying.";
            throw ValidationException::withMessages([
                'email' => "Cross-check your reset credentials."
            ]);
        }

        $this->status = Password::reset($this->all(), function (User $user, string $password) {
            $user->forceFill(['password' => Hash::make($password)])
                ->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        if ($this->status === Password::PASSWORD_RESET) {
            session()->flash('status', __($this->status));
            return $this->redirectRoute('app.login', navigate: true);
        }

        $this->reset('email');
    }
}
