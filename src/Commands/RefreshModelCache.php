<?php

namespace Khairul\AutoRefreshCache\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RefreshModelCache extends Command
{
    protected $signature = 'cache:refresh';
    protected $description = 'Refresh cached data for all cache-aware models';

    public function handle()
    {
        $models = config('auto_refresh_cache.models', []);

        foreach ($models as $model) {
            if (method_exists($model, 'allFromCache') && property_exists($model, 'cacheKey')) {
                $cacheKey = $model::$cacheKey ?? null;

                if ($cacheKey) {
                    Cache::forget($cacheKey);
                }

                $model::allFromCache();
                $this->info("✅ Cache refreshed for: {$model}");
            } else {
                $this->warn("⚠️ {$model} is missing AutoRefreshCache setup.");
            }
        }

        $this->info('🎉 All model caches refreshed successfully!');
        return Command::SUCCESS;
    }
}
