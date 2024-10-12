<?php

namespace Database\Seeders;

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
                'email' => 'ron@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('ronronron'),
                'remember_token' => Str::random(10),
                'image' => 'members/Ron.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $ron->roles()->attach($role);

    }
}
