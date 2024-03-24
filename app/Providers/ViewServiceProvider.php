<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Category;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Of alleen voor specifieke views
        view()->composer(['home', 'post','category'], function ($view) {
            $view->with('postTickers', Post::with(['photo', 'categories'])->latest('created_at')->take(6)->get());
            $view->with('postCategories', Category::all());
        });
    }
}
