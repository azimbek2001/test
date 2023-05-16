<?php

namespace App\Providers;

use App\Services\Plot\Interfaces\PlotServiceInterface;
use App\Services\Plot\PlotService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PlotServiceInterface::class, PlotService::class);
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
