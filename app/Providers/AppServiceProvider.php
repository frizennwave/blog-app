<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrapFive();

        Blade::if('role', function (string|array $role) {
            return Auth::check() && Auth::user()->hasRole($role);
        });

        Gate::define('update-blog', function (User $user, Blog $blog) {
            return $user->id === $blog->user_id || $user->role === 'admin';
        });
    }
}
