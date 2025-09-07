<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertificationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ping', fn () => 'pong');
Route::view('/dashboard', 'welcome')->middleware('auth')->name('dashboard');

Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
Route::get('/certifications/{slug}', [CertificationController::class, 'show'])->name('certifications.show');
