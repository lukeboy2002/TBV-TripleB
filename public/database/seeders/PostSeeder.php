<?php

namespace public\database\seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Post::factory(30)->create();
        \App\Models\Category::factory(30)->create();



    }
}
