<?php

namespace Database\Seeders;

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
                'email' => 'frans@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('fransfrans'),
                'remember_token' => Str::random(10),
                'image' => 'members/Frans.png',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $frans->roles()->attach($role);
    }
}
