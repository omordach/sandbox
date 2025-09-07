<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('loads the welcome page', function () {
    $this->withoutVite();
    $response = $this->get('/');

    $response->assertOk();
});

it('redirects settings to profile', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->actingAs($user)->get('/settings');

    $response->assertRedirect('/settings/profile');
});
