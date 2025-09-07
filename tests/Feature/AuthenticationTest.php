<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::get('/login', fn () => 'login');
});

it('displays the login page', function () {
    $response = $this->get('/login');

    $response->assertOk();
});
