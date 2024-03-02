<?php

// app/Providers/CustomValidationServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class BrandValidationServiceProvider extends ServiceProvider
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
        Validator::extend('unique_categories', function ($attribute, $value, $parameters, $validator) {
            // Check if $value is an array
            if (!is_array($value)) {
                return false;
            }

            // Check if there are any duplicate values
            return count($value) === count(array_unique($value));
        });
    }
}
