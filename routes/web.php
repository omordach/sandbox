<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/ping', fn () => 'pong');
Route::view('/dashboard', 'welcome')->middleware('auth')->name('dashboard');

