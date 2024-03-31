<?php

use App\Livewire\Auth\Login;
use App\Livewire\Admin\Staff;
use App\Livewire\Admin\Profile;
use App\Livewire\Auth\Register;
use App\Livewire\Website\Index;
use App\Livewire\Admin\Finances;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Students;
use App\Livewire\Admin\Academics;
use App\Livewire\Admin\Guardians;
use App\Livewire\Auth\SelectRole;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Student\Dashboard as StudentDashboard;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Guardian\Dashboard as GuardianDashboard;
use App\Livewire\Staff\Dashboard as StaffDashboard;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Main Domain
Route::get('', Index::class)->name('index');

// Role Selection
Route::middleware('auth')->prefix('role')->group(function () {
    Route::get('select', SelectRole::class)->name('role.select');
});

// Password Reset
Route::middleware('guest')->name('password.')->group(function () {
    Route::get('/forgot-password', ForgotPassword::class)->name('request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('reset');
});

// Email Verification
Route::middleware('auth')->name('verification.')->group(function () {
    Route::get('/email/verify', VerifyEmail::class)->name('notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended();
    })->middleware('signed')->name('verify');
});

// Terms and Privacy Policy
Route::middleware('cache.headers:public;max_age=2682000;etag')->group(function () {
    Route::view('terms-of-service', 'terms-of-service', ['title' => 'Terms of Service'])->name('terms');
    Route::view('privacy-policy', 'privacy-policy', ['title' => 'Privacy Policy'])->name('privacy');
});

// Application
Route::name('app.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::prefix('portal')->group(function () {
            Route::get('sign-in', Login::class)->name('login');
            Route::get('sign-up', Register::class)->name('register');
        });
    });
    // Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('dashboard', AdminDashboard::class)->name('dashboard');
            Route::get('academics', Academics::class)->name('academics');
            Route::get('students', Students::class)->name('students');
            Route::get('staff', Staff::class)->name('staff');
            Route::get('guardians', Guardians::class)->name('guardians');
            Route::get('finances', Finances::class)->name('finances');
            Route::get('settings', Settings::class)->name('settings');
            Route::get('profile', Profile::class)->name('profile');
        });
        Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
            Route::get('dashboard', StudentDashboard::class)->name('dashboard');
        });
        Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
            Route::get('dashboard', StaffDashboard::class)->name('dashboard');
        });
        Route::middleware('role:guardian')->prefix('guardian')->name('guardian.')->group(function () {
            Route::get('dashboard', GuardianDashboard::class)->name('dashboard');
        });
    });
});

Route::get('/laravel', function () {
    return view('welcome');
});