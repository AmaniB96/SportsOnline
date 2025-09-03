<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        Gate::define("isAdmin", function ($user) {
            return $user->role_id == 3;
        });
        Gate::define("isAdminorCoach", function ($user) {
            return in_array($user->role_id, [2, 3]);
        });
        Gate::define("isCoach", function ($user) {
            return $user->role_id == 2;
        });
    }
}
