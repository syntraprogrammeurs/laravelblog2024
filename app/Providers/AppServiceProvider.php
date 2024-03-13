<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();
        $usersCount = User::count();
        $postsCount = Post::count();

        view()->share('usersCount', $usersCount);
        view()->share('postsCount', $postsCount);
    }
}
