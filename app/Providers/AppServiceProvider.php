<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $Blogs = DB::table('blogs')->where('published', 1)->orderByDesc('id')->take(5)->get();
        $Teams=DB::table('teams')->get();
        View::share('Blogs',$Blogs);
        View::share('Teams',$Teams);
    }
}
