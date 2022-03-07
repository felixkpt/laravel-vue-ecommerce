<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('appName', config('app.name'));
        Inertia::share('url', url('').'/');
        Inertia::share('current_url', url()->current());
        Inertia::share('asset', asset(''));

        Inertia::share('successMessage', function(){
            return session()->get('successMessage') ? session()->get('successMessage') : null;
        });
        Inertia::share('info', function(){
            return session()->get('info') ? session()->get('info') : null;
        });
        Inertia::share('light', function(){
            return session()->get('light') ? session()->get('light') : null;
        });
        Inertia::share('warning', function(){
            return session()->get('warning') ? session()->get('warning') : null;
        });
        Inertia::share('danger', function(){
            return session()->get('danger') ? session()->get('danger') : null;
        });

        Inertia::share('canLogin', function(){
            return Route::has('login');
        });
        Inertia::share('canRegister', function(){
            return Route::has('register');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
