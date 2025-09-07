<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('requires authentication for profile settings', function () {
    $response = $this->get('/settings/profile');

    $response->assertRedirect('/login');
});

it('updates the user profile', function () {
    $user = User::create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->actingAs($user)->patch('/settings/profile', [
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);

    $response->assertRedirect('/settings/profile');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);
});
