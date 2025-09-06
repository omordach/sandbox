<?php

return [
    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'locale' => env('APP_LOCALE', 'en'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'cipher' => 'AES-256-CBC',
    'providers' => [
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        App\Providers\AppServiceProvider::class,
        App\Providers\Filament\AdminPanelProvider::class,
    ],
];
