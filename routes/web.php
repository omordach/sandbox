<?php

declare(strict_types=1);

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ping', fn () => 'pong')->middleware('throttle:60,1');
Route::view('/dashboard', 'welcome')->middleware('auth')->name('dashboard');

Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
Route::get('/certifications/{slug}', [CertificationController::class, 'show'])->name('certifications.show');
