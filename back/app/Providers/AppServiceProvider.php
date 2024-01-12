<?php

namespace App\Providers;

use App\Repositories\BtcUsdRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\BtcUsdRepositoryInterface;
use GuzzleHttp\Client as Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {   
        $this->app->bind(
            BtcUsdRepositoryInterface::class,
            BtcUsdRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
