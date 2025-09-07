<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ron = User::factory()
            ->create([
                'username' => 'ron',
                'name' => 'Ron van Roosendaal',
                'email' => 'ron@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('ronronron'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $ron->roles()->attach($role);

        $ron = Profile::factory()
            ->create([
                'user_id' => $ron->id,
                'image_path' => 'members/Ron.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);

    }
}
