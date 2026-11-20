<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * Maakt een speler met de rol "member" aan.
 */
function apiPlayer(array $attributes = []): User
{
    Role::firstOrCreate(['name' => 'member']);

    return tap(User::factory()->create($attributes))->assignRole('member');
}
