# Laravel Auto Refresh Cache Package

This package provides an easy way to auto-refresh cache for Laravel models on save/delete actions.

## Installation

```bash
composer require khairul/laravel-auto-refresh-cache:dev-main
```

Open config/app.php and add the following line to the providers array:

```bash
'providers' => [
    // Other service providers...

    Khairul\AutoRefreshCache\AutoRefreshCacheServiceProvider::class,
],
```

## Publish Config

```bash
php artisan vendor:publish --tag=config --provider="Khairul\AutoRefreshCache\AutoRefreshCacheServiceProvider"
```

## Configuration

Add your cache-aware models to `config/auto_refresh_cache.php`:

```php
return [
    'models' => [
        App\Models\CancelReason::class,
        App\Models\ProductCategory::class,
    ],
];
```

## Usage

In your model, use the trait and set the cache key:

```php
use Khairul\AutoRefreshCache\Traits\AutoRefreshCache;

class CancelReason extends Model
{
    use AutoRefreshCache;

    protected static string $cacheKey = 'cancel_reasons_all';
}
```

Fetch cached data:

```php
$cancelReasons = CancelReason::allFromCache();
```

## Refresh Cache Manually

Run this artisan command to refresh all caches:

```bash
php artisan cache:refresh
```
