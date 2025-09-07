<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class GuusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guus = User::factory()
            ->create([
                'username' => 'guus',
                'name' => 'Guus Lemmers',
                'email' => 'guus@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('guusguus'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $guus->roles()->attach($role);

        $guus = Profile::factory()
            ->create([
                'user_id' => $guus->id,
                'image_path' => 'members/guus.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
