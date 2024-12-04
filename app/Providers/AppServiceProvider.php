<?php

namespace App\Providers;

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
        $this->app->singleton(\App\Services\FacebookAdsService::class, function ($app) {
            return new \App\Services\FacebookAdsService();
        });
        
        $this->app->singleton(\App\Services\Tiktok\TikTokService::class, function ($app) {
            return new \App\Services\Tiktok\TikTokService();
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
