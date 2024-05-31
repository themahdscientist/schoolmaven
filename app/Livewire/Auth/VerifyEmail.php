<?php

namespace App\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

// @author The MAHD SCIENTIST <tms@iamnoel.com>
#[Layout('components.layouts.security')]
#[Title('Email Verification')]
class VerifyEmail extends Component
{
    use WithRateLimiting;

    public $error;

    public $message;

    public function send()
    {
        try {
            $this->rateLimit(1);
        } catch (TooManyRequestsException $exception) {
            $this->error = "Too many email requests! Please wait another {$exception->secondsUntilAvailable} seconds before retrying.";

            return;
        }

        request()->user()->sendEmailVerificationNotification();

        $this->message = 'Verification link sent!';
    }

    public function updating()
    {
        $this->error = null;
    }
}
