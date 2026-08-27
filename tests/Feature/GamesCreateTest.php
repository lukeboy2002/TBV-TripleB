<?php

use App\Livewire\Games\GamesCreate;
use App\Models\Game;
use App\Models\User;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

test('games create screen can select and deselect all players', function () {
    Role::firstOrCreate(['name' => 'member']);

    $user1 = User::factory()->create(['username' => 'playerone']);
    $user1->assignRole('member');

    $user2 = User::factory()->create(['username' => 'playertwo']);
    $user2->assignRole('member');

    $user3 = User::factory()->create(['username' => 'playerthree']);
    $user3->assignRole('member');

    $component = Livewire::test(GamesCreate::class);

    // Initial state: no players selected
    expect($component->get('selectedPlayers'))->toBeEmpty();
    expect($component->instance()->areAllPlayersSelected())->toBeFalse();

    // Call toggleSelectAll -> should select all members
    $component->call('toggleSelectAll');
    expect($component->get('selectedPlayers'))->toHaveCount(3);
    expect($component->instance()->areAllPlayersSelected())->toBeTrue();
    $component->assertSee(__('Deselect all'));

    // Call toggleSelectAll again -> should deselect all
    $component->call('toggleSelectAll');
    expect($component->get('selectedPlayers'))->toBeEmpty();
    expect($component->instance()->areAllPlayersSelected())->toBeFalse();
    $component->assertSee(__('Select all'));

    // Call selectAll -> should select all members
    $component->call('selectAll');
    expect($component->get('selectedPlayers'))->toHaveCount(3);
    expect($component->instance()->areAllPlayersSelected())->toBeTrue();

    // Call deselectAll -> should deselect all
    $component->call('deselectAll');
    expect($component->get('selectedPlayers'))->toBeEmpty();
    expect($component->instance()->areAllPlayersSelected())->toBeFalse();
});

test('players present are ordered alphabetically in the first game of the day', function () {
    Role::firstOrCreate(['name' => 'member']);

    $userZ = User::factory()->create(['username' => 'zoe']);
    $userZ->assignRole('member');

    $userA = User::factory()->create(['username' => 'adam']);
    $userA->assignRole('member');

    $userM = User::factory()->create(['username' => 'mike']);
    $userM->assignRole('member');

    $game = Game::create([
        'date' => now(),
        'status' => 'in_progress',
    ]);

    $game->gamePlayers()->create(['user_id' => $userZ->id]);
    $game->gamePlayers()->create(['user_id' => $userA->id]);
    $game->gamePlayers()->create(['user_id' => $userM->id]);

    $component = Livewire::test(GamesCreate::class);

    $presentPlayers = $component->instance()->presentGamePlayers;
    $usernames = $presentPlayers->map(fn ($gp) => $gp->user->username)->values()->toArray();

    expect($usernames)->toEqual(['adam', 'mike', 'zoe']);
});

test('players present in subsequent games are ordered by points of the previous game and non participants last', function () {
    Role::firstOrCreate(['name' => 'member']);

    $user1 = User::factory()->create(['username' => 'alice']);
    $user1->assignRole('member');

    $user2 = User::factory()->create(['username' => 'bob']);
    $user2->assignRole('member');

    $user3 = User::factory()->create(['username' => 'charlie']);
    $user3->assignRole('member');

    $user4 = User::factory()->create(['username' => 'david']);
    $user4->assignRole('member');

    // First game completed: Alice had 10 points, Bob had 14 points, Charlie had 8 points. David did not play.
    $firstGame = Game::create([
        'date' => now(),
        'status' => 'completed',
        'completed_at' => now()->subMinutes(10),
    ]);

    $firstGame->gamePlayers()->create(['user_id' => $user1->id, 'points' => 10, 'position' => 2]);
    $firstGame->gamePlayers()->create(['user_id' => $user2->id, 'points' => 14, 'position' => 3, 'is_winner' => true]);
    $firstGame->gamePlayers()->create(['user_id' => $user3->id, 'points' => 8, 'position' => 1]);

    // Second game in progress with all 4 players
    $secondGame = Game::create([
        'date' => now(),
        'status' => 'in_progress',
    ]);

    $secondGame->gamePlayers()->create(['user_id' => $user4->id]);
    $secondGame->gamePlayers()->create(['user_id' => $user1->id]);
    $secondGame->gamePlayers()->create(['user_id' => $user3->id]);
    $secondGame->gamePlayers()->create(['user_id' => $user2->id]);

    $component = Livewire::test(GamesCreate::class);

    $presentPlayers = $component->instance()->presentGamePlayers;
    $usernames = $presentPlayers->map(fn ($gp) => $gp->user->username)->values()->toArray();

    // Bob (14 pts) -> Alice (10 pts) -> Charlie (8 pts) -> David (did not play, added last)
    expect($usernames)->toEqual(['bob', 'alice', 'charlie', 'david']);
});
