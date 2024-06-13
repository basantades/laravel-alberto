<?php

namespace App\Providers;

use App\Http\Controllers\AdminUsersController;
use App\Policies\UserAdminPolicy;
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
        //
        // Gate::policy(AdminUsersController::class, UserAdminPolicy::class);
    }
}
