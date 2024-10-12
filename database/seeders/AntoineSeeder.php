<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AntoineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $antoine = User::factory()
            ->create([
                'username' => 'antoine',
                'email' => 'antoine@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('antoineantoine'),
                'remember_token' => Str::random(10),
                'image' => 'members/Antoine.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $antoine->roles()->attach($role);
    }
}
