<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::get('/', fn () => 'home');
    Route::get('login', fn () => 'login');
    Route::get('register', fn () => 'register');
});

it('loads the home page', function () {
    $this->get('/')->assertOk();
});

it('loads the login page', function () {
    $this->get('/login')->assertOk();
});

it('loads the registration page', function () {
    $this->get('/register')->assertOk();
});
