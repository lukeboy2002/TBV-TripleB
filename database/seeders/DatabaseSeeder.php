<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $members = [[
            $this->call(AdminSeeder::class),
        ]];
        $members = User::all();

        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $role = Role::select('id')->where('name', 'user')->first();
            $user->roles()->attach($role);
            $profile = Profile::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
