<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Detection\MobileDetect;

class MobileDetectServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $browser = new MobileDetect();

        View::share('browser', $browser);
    }
}
