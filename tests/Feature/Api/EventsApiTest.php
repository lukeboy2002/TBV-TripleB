<?php

use App\Models\Event;
use Laravel\Sanctum\Sanctum;

require_once __DIR__.'/ApiTestHelpers.php';

test('players see upcoming events and can set their attendance', function () {
    $anna = apiPlayer();
    Sanctum::actingAs($anna);

    $event = Event::factory()->create(['date' => now()->addDays(3), 'end_date' => null]);
    Event::factory()->create(['date' => now()->subWeek(), 'end_date' => null]);

    $this->getJson('/api/events')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.slug', $event->slug)
        ->assertJsonPath('data.0.my_status', null);

    $this->putJson("/api/events/{$event->slug}/attendance", ['status' => 'attending'])
        ->assertOk()
        ->assertJsonPath('data.my_status', 'attending')
        ->assertJsonPath('data.counts.attending', 1);

    // Nog een keer zetten past dezelfde aanmelding aan, in plaats van een tweede te maken.
    $this->putJson("/api/events/{$event->slug}/attendance", ['status' => 'maybe'])
        ->assertJsonPath('data.counts.attending', 0)
        ->assertJsonPath('data.counts.maybe', 1);

    $this->getJson("/api/events/{$event->slug}")
        ->assertOk()
        ->assertJsonPath('data.attendees.0.player.id', $anna->id)
        ->assertJsonPath('data.attendees.0.status', 'maybe');
});

test('attendance status is validated', function () {
    Sanctum::actingAs(apiPlayer());
    $event = Event::factory()->create();

    $this->putJson("/api/events/{$event->slug}/attendance", ['status' => 'misschien'])
        ->assertStatus(422);
});
