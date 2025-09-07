<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/settings/profile', fn () => 'profile')->name('profile.edit');
        Route::patch('/settings/profile', function () {
            request()->user()->update([
                'name' => request('name'),
                'email' => request('email'),
            ]);

            return redirect('/settings/profile');
        })->name('profile.update');
    });
});

it('shows profile page for authenticated users', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/settings/profile');

    $response->assertOk();
});

it('updates profile information', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->patch('/settings/profile', [
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);

    $response->assertRedirect('/settings/profile');

    expect($user->fresh())
        ->name->toBe('New Name')
        ->email->toBe('new@example.com');
});
