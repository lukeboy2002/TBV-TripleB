<?php

namespace Database\Seeders;

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
                'email' => 'johan@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('johanjohan'),
                'remember_token' => Str::random(10),
                'image' => 'members/Johan.jpg',
            ]);
        $role = Role::select('id')->where('name', 'member')->first();
        $johan->roles()->attach($role);
    }
}
