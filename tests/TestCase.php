<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Create the application instance for testing.
     */
    public function createApplication(): Application
    {
        $env = dirname(__DIR__).'/.env';

        if (! is_file($env)) {
            file_put_contents($env, '');
            register_shutdown_function(static fn () => @unlink($env));
        }

        return parent::createApplication();
    }
}
