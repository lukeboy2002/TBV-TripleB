<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class JacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jac = User::factory()
            ->create([
                'username' => 'jac',
                'name' => 'Jac van Gool',
                'email' => 'jac@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('jacjacjac'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $jac->roles()->attach($role);

        $jac = Profile::factory()
            ->create([
                'user_id' => $jac->id,
                'image_path' => 'members/Jac.png',
                'city' => 'Tilburg',
                'biography' => '',
            ]);
    }
}
