<?php

namespace Database\Seeders;

use App\Models\Profile;
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
                'name' => 'Antoine Hendriks',
                'email' => 'antoine@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('antoineantoine'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $antoine->roles()->attach($role);

        $antoine = Profile::factory()
            ->create([
                'user_id' => $antoine->id,
                'image_path' => 'members/Antoine.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
