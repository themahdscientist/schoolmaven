<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\School::observe(\App\Observers\SchoolObserver::class);
        \App\Models\Staff::observe(\App\Observers\StaffObserver::class);

        \Illuminate\Support\Facades\Gate::define('view-admin', function (\App\Models\User $user) {
            return $user->roles->contains('name', 'admin') && (session('role') == 'admin');
        });

        \Illuminate\Support\Facades\Gate::define('view-staff', function (\App\Models\User $user) {
            return $user->roles->contains('name', 'staff') && (session('role') == 'staff');
        });

        \Illuminate\Support\Facades\Gate::define('view-student', function (\App\Models\User $user) {
            return $user->roles->contains('name', 'student') && (session('role') == 'student');
        });

        \Illuminate\Support\Facades\Gate::define('view-guardian', function (\App\Models\User $user) {
            return $user->roles->contains('name', 'guardian') && (session('role') == 'guardian');
        });

        \Filament\Support\Facades\FilamentColor::register([
            'danger' => \Filament\Support\Colors\Color::hex('#D81E5B'),
            'gray' => \Filament\Support\Colors\Color::hex('#242423'),
            'info' => \Filament\Support\Colors\Color::hex('#058ED9'),
            'primary' => \Filament\Support\Colors\Color::hex('#4AAD52'),
            'success' => \Filament\Support\Colors\Color::hex('#32CD32'),
            'warning' => \Filament\Support\Colors\Color::hex('#FFD700'),
        ]);

        \Filament\Tables\Columns\Column::configureUsing(
            fn (\Filament\Tables\Columns\Column $column) => $column
                ->searchable()
                ->alignCenter()
                ->verticallyAlignCenter()
        );
    }
}
