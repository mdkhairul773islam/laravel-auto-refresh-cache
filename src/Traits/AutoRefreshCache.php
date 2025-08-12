<?php

namespace Khairul\AutoRefreshCache\Traits;

use Illuminate\Support\Facades\Cache;

trait AutoRefreshCache
{
    protected static string $cacheKey;

    protected static function bootAutoRefreshCache()
    {
        static::saved(function () {
            Cache::forget(static::$cacheKey);
        });

        static::deleted(function () {
            Cache::forget(static::$cacheKey);
        });
    }

    public static function allFromCache()
    {
        return Cache::rememberForever(static::$cacheKey, fn() => static::all());
    }
}
