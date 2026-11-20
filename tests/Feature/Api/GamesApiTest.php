<?php

use App\Models\Game;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

require_once __DIR__.'/ApiTestHelpers.php';

test('a full game can be played through the api', function () {
    $anna = apiPlayer(['username' => 'anna']);
    $bram = apiPlayer(['username' => 'bram']);
    $cees = apiPlayer(['username' => 'cees']);
    Sanctum::actingAs($anna);

    $this->getJson('/api/games/current')->assertOk()->assertJsonPath('data', null);

    $gameId = $this->postJson('/api/games', ['players' => [$anna->id, $bram->id, $cees->id]])
        ->assertCreated()
        ->assertJsonCount(3, 'data.remaining')
        ->json('data.id');

    // Er kan maar één wedstrijd tegelijk lopen.
    $this->postJson('/api/games', ['players' => [$anna->id, $bram->id]])->assertStatus(409);

    // Bram valt als eerste af (beker), Cees als tweede: Anna wint.
    $this->postJson("/api/games/{$gameId}/eliminate", ['user_id' => $bram->id])
        ->assertOk()
        ->assertJsonPath('completed', false)
        ->assertJsonCount(2, 'data.remaining')
        ->assertJsonPath('data.eliminated.0.player.id', $bram->id);

    // Dezelfde speler nog eens laten afvallen mag niet.
    $this->postJson("/api/games/{$gameId}/eliminate", ['user_id' => $bram->id])->assertStatus(422);

    $this->postJson("/api/games/{$gameId}/eliminate", ['user_id' => $cees->id])
        ->assertOk()
        ->assertJsonPath('completed', true)
        ->assertJsonPath('data.status', 'completed')
        ->assertJsonPath('data.players.0.player.id', $anna->id)
        ->assertJsonPath('data.players.0.is_winner', true)
        ->assertJsonPath('data.players.0.points', 16)
        ->assertJsonPath('data.players.2.player.id', $bram->id)
        ->assertJsonPath('data.players.2.has_cup', true);

    $this->getJson('/api/games/current')->assertJsonPath('data', null);
    $this->getJson('/api/games')->assertOk()->assertJsonCount(1, 'data');
    $this->getJson("/api/games/{$gameId}")->assertOk()->assertJsonCount(3, 'data.players');
});

test('starting a game needs at least two players', function () {
    $anna = apiPlayer();
    Sanctum::actingAs($anna);

    $this->postJson('/api/games', ['players' => [$anna->id]])
        ->assertStatus(422)
        ->assertJsonValidationErrors('players');
});

test('a cup photo can be uploaded after the game', function () {
    Storage::fake('public');
    $anna = apiPlayer();
    $bram = apiPlayer();
    Sanctum::actingAs($anna);

    $game = Game::create(['date' => now(), 'status' => 'completed', 'completed_at' => now()]);
    $game->gamePlayers()->create(['user_id' => $bram->id, 'position' => 1, 'points' => 13]);
    $game->gamePlayers()->create(['user_id' => $anna->id, 'position' => 2, 'points' => 16, 'is_winner' => true]);

    $this->postJson("/api/games/{$game->id}/cup-photo", [
        'photo' => UploadedFile::fake()->image('beker.jpg'),
    ])->assertOk()->assertJsonPath('data.player.id', $bram->id);

    expect($game->gamePlayers()->where('position', 1)->first()->cup_photo_path)->not->toBeNull();

    $this->getJson('/api/cup-winner')
        ->assertOk()
        ->assertJsonPath('data.player.id', $bram->id)
        ->assertJsonPath('data.game_id', $game->id);
});

test('the standings list players with their stats', function () {
    $anna = apiPlayer(['username' => 'anna']);
    $bram = apiPlayer(['username' => 'bram']);
    Sanctum::actingAs($anna);

    $game = Game::create(['date' => now(), 'status' => 'completed', 'completed_at' => now()]);
    $game->gamePlayers()->create(['user_id' => $bram->id, 'position' => 1, 'points' => 13]);
    $game->gamePlayers()->create(['user_id' => $anna->id, 'position' => 2, 'points' => 16, 'is_winner' => true]);

    $this->getJson('/api/players?sort=points&dir=desc')
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.id', $anna->id)
        ->assertJsonPath('data.0.stats.points', 16)
        ->assertJsonPath('data.0.stats.won', 1)
        ->assertJsonPath('data.1.stats.cups', 1)
        ->assertJsonMissingPath('data.0.email');
});
