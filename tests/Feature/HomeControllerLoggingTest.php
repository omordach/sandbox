<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

it('logs database errors and still renders the homepage', function () {
    Log::spy();

    // Force a database error when querying certifications
    Schema::drop('certifications');

    $this->withoutVite();
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('No certifications yet.');

    Log::shouldHaveReceived('error');
});
