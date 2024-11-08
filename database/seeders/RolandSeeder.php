<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RolandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roland = User::factory()
            ->create([
                'username' => 'roland',
                'email' => 'roland@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('rolandroland'),
                'remember_token' => Str::random(10),
                'image' => 'members/Roland.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $roland->roles()->attach($role);
    }
}
