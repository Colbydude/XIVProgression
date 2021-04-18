<?php

namespace App\Providers;

use App\Services\XIVAPIServiceInterface;
use App\Services\XIVAPIService;
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
        $this->app->singleton(XIVAPIServiceInterface::class, XIVAPIService::class);
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
