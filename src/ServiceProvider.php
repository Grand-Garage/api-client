<?php

namespace Grandgarage\ApiClient;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/apiClient.php';
        $this->mergeConfigFrom($configPath, 'apiClient');
    }


    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/apiClient.php';
        $this->publishes([$configPath => config_path('apiClient.php')], 'config');
    }
}
