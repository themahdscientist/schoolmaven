<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->check()) {
            $user = User::query()->findOrFail(auth()->id())->load('roles:id,name');

            // Get the user's roles
            $roles = $user->roles;

            // Dashboard
            if ($role == 'index') {
                session(['role' => $roles->first()->name]);

                return $next($request);
            }

            // If the user has only one role and there's no role in the session
            if ($roles->count() == 1 && ! session()->has('role')) {
                // Store their role in the session
                session(['role' => $roles->first()->name]);

                // Redirect to their {role}/dashboard
                return redirect()->route('app.'.session('role').'.dashboard');
            }

            // If the user has more than one role and there's no role in the session
            if ($roles->count() > 1 && ! session()->has('role')) {
                return redirect()->route('role.select');
            }

            // If the user doesn't contain the role they're requesting for
            if (! $roles->contains('name', $role)) {
                return back();
            }

            // If there's a role in the session
            return $next($request);
        }

        // If there's no authenticated user in the session
        return $next($request);
    }
}
