<?php

namespace App\Providers;

use App\Models\User;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentColor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-admin', function (User $user) {
            return $user->roles->contains('name', 'admin') && (session('role') == 'admin');
        });

        Gate::define('view-staff', function (User $user) {
            return $user->roles->contains('name', 'staff') && (session('role') == 'staff');
        });

        Gate::define('view-student', function (User $user) {
            return $user->roles->contains('name', 'student') && (session('role') == 'student');
        });

        Gate::define('view-guardian', function (User $user) {
            return $user->roles->contains('name', 'guardian') && (session('role') == 'guardian');
        });

        FilamentColor::register([
            'danger' => Color::hex('#D81E5B'),
            'gray' => Color::hex('#242423'),
            'info' => Color::hex('#058ED9'),
            'primary' => Color::hex('#4AAD52'),
            'success' => Color::hex('#32CD32'),
            'warning' => Color::hex('#FFD700'),
        ]);
    }
}
