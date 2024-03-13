<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        // Gebruik een view composer die nakijkt of de tabellen reeds bestaan.
        View::composer('*', function ($view) {
            if (Schema::hasTable('users') && Schema::hasTable('posts')) {
                $usersCount = User::count();
                $postsCount = Post::count();

                $view->with('usersCount', $usersCount)
                    ->with('postsCount', $postsCount);
            }
        });
    }
}
