<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class JohnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $john = User::factory()
            ->create([
                'username' => 'john',
                'email' => 'john@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('johnjohn'),
                'remember_token' => Str::random(10),
                'image' => 'members/John.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $john->roles()->attach($role);
    }
}
