<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            $this->call(AlbertSeeder::class),
            $this->call(AntoineSeeder::class),
            $this->call(BeukSeeder::class),
            $this->call(BudSeeder::class),
            $this->call(FransSeeder::class),
            $this->call(GuusSeeder::class),
            $this->call(JacSeeder::class),
            $this->call(JohanSeeder::class),
            $this->call(JohnSeeder::class),
            $this->call(PatrickSeeder::class),
            $this->call(RichardSeeder::class),
            $this->call(RolandSeeder::class),
            $this->call(RonSeeder::class),
            $this->call(RuudSeeder::class),
        ]];
        $members = User::all();

        $users = User::factory(10)->create();

    }
}
