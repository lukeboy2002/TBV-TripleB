<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class JohanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $johan = User::factory()
            ->create([
                'username' => 'johan',
                'name' => 'Johan van Turnhout',
                'email' => 'johan@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('johanjohan'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $johan->roles()->attach($role);

        $johan = Profile::factory()
            ->create([
                'user_id' => $johan->id,
                'image_path' => 'members/Johan.jpg',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
