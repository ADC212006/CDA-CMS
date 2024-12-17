<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

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
        // Fetch the APP_URL from the environment or use the URL function as a fallback
        $appUrl = Request::root(); // Get the current request URL

        // Set the application URL
        Config::set('app.url', $appUrl);

        // Debug output (optional)
        // dd(Config::get('app.url')); // Uncomment for debugging
    }
}
