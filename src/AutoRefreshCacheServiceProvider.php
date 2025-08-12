<?php

namespace Khairul\AutoRefreshCache;

use Illuminate\Support\ServiceProvider;
use Khairul\AutoRefreshCache\Commands\RefreshModelCache;

class AutoRefreshCacheServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/auto_refresh_cache.php',
            'auto_refresh_cache'
        );
    }

    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/config/auto_refresh_cache.php' => config_path('auto_refresh_cache.php'),
        ], 'auto-refresh-cache-config');

        // Register command
        if ($this->app->runningInConsole()) {
            $this->commands([
                RefreshModelCache::class,
            ]);
        }
    }
}