<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albert = User::factory()
            ->create([
                'username' => 'admin',
                'email' => 'admin@tbv-tripleb.nl',
                'email_verified_at' => now(),
                'password' => Hash::make('adminadmin'),
                'remember_token' => Str::random(10),
            ]);
        $role = Role::select('id')->where('name', 'admin')->first();
        $albert->roles()->attach($role);
    }
}
