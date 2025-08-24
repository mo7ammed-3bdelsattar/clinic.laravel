<?php

namespace App\Providers;

use App\Models\Banner;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.layouts.footer',function($view){
            $view->with('banner_footer',Banner::where('name', 'footer')->first());
        });
        Paginator::useBootstrapFive();
     }
}
