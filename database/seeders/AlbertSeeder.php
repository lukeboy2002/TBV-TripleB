<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AlbertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albert = User::factory()
            ->create([
                'username' => 'albert',
                'name' => 'Albert Kolen',
                'email' => 'albert@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('albertalbert'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $albert->roles()->attach($role);

        $albert = Profile::factory()
            ->create([
                'user_id' => $albert->id,
                'image_path' => 'members/Albert.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
