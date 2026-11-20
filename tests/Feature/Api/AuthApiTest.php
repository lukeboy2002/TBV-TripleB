<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

require_once __DIR__.'/ApiTestHelpers.php';

test('a player can log in and receives a token', function () {
    $player = apiPlayer(['email' => 'speler@example.com', 'password' => 'geheim123']);

    $response = $this->postJson('/api/login', [
        'email' => 'speler@example.com',
        'password' => 'geheim123',
        'device_name' => 'iPhone test',
    ]);

    $response->assertOk()
        ->assertJsonStructure(['token', 'user' => ['id', 'username', 'email', 'roles', 'avatar_url']])
        ->assertJsonPath('user.id', $player->id);

    expect($player->tokens()->count())->toBe(1);
});

test('login fails with a wrong password', function () {
    apiPlayer(['email' => 'speler@example.com', 'password' => 'geheim123']);

    $this->postJson('/api/login', [
        'email' => 'speler@example.com',
        'password' => 'fout',
        'device_name' => 'iPhone test',
    ])->assertStatus(422)->assertJsonValidationErrors('email');
});

test('banned players and non players cannot log in', function () {
    apiPlayer(['email' => 'banned@example.com', 'password' => 'geheim123', 'is_banned' => true]);
    User::factory()->create(['email' => 'guest@example.com', 'password' => 'geheim123']);

    foreach (['banned@example.com', 'guest@example.com'] as $email) {
        $this->postJson('/api/login', [
            'email' => $email,
            'password' => 'geheim123',
            'device_name' => 'iPhone test',
        ])->assertStatus(422);
    }
});

test('me returns the logged in player and logout revokes the token', function () {
    $player = apiPlayer();
    $token = $player->createToken('test')->plainTextToken;

    $this->withToken($token)->getJson('/api/me')
        ->assertOk()
        ->assertJsonPath('data.id', $player->id);

    $this->withToken($token)->postJson('/api/logout')->assertNoContent();

    expect($player->tokens()->count())->toBe(0);
});

test('the api requires a token', function () {
    $this->getJson('/api/players')->assertUnauthorized();
});

test('a player banned after login is blocked', function () {
    $player = apiPlayer();
    Sanctum::actingAs($player);
    $player->forceFill(['is_banned' => true])->save();

    $this->getJson('/api/players')->assertForbidden();
});
