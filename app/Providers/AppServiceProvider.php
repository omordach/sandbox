<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('database.default') === 'sqlite') {
            $database = config('database.connections.sqlite.database');

            if ($database !== ':memory:' && ! file_exists($database)) {
                $dir = dirname($database);
                if (! is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }

                touch($database);
            }
        }
    }
}
