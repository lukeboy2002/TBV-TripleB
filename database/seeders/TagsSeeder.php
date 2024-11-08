<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TAG MODEL
        $tag1 = Tag::create(['name' => 'Test', 'slug' => 'test']);
        $tag2 = Tag::create(['name' => 'Test2', 'slug' => 'test2']);
        $tag3 = Tag::create(['name' => 'Antoine', 'slug' => 'antoine']);
        $tag4 = Tag::create(['name' => 'Alice', 'slug' => 'alice']);
    }
}
