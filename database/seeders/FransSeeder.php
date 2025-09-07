<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class FransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frans = User::factory()
            ->create([
                'username' => 'frans',
                'name' => 'Frans van Kempen',
                'email' => 'frans@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('fransfrans'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $frans->roles()->attach($role);

        $frans = Profile::factory()
            ->create([
                'user_id' => $frans->id,
                'image_path' => 'members/Frans.png',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
