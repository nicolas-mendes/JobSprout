<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Password;
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

        Model::unguard();

        Password::defaults(function () {
            return 
                Password::min(8)
                ->max(255)
                ->mixedCase()
                ->numbers()
                ->symbols();
        });

    }
}
