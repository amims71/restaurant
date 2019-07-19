<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;


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
    public function boot(Request $request)
    {
        // if ($request->session()->has('name')) {
        //     view()->share('name', $request->session()->get('name'));
        // } else{
        //     view()->share('name', "Guest");
        // }
        // view()->share('name', $request->session()->get('name'));
    }
}
