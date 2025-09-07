<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class PatrickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patrick = User::factory()
            ->create([
                'username' => 'patrick',
                'name' => 'Patrick Engel',
                'email' => 'patrick@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('patrickpatrick'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $patrick->roles()->attach($role);

        $patrick = Profile::factory()
            ->create([
                'user_id' => $patrick->id,
                'image_path' => 'members/Patrick.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
