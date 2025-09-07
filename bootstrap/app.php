<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/auth.php',
            __DIR__.'/../routes/settings.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/ping',
    )
    ->withMiddleware()
    ->withExceptions()
    ->create();
