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
        $tag1 = Tag::create(['name' => 'Tag1', 'slug' => 'tag_1']);
        $tag2 = Tag::create(['name' => 'Tag2', 'slug' => 'tag_2']);
        $tag3 = Tag::create(['name' => 'Tag3', 'slug' => 'tag_3']);
        $tag4 = Tag::create(['name' => 'Tag4', 'slug' => 'tag_4']);
        $tag5 = Tag::create(['name' => 'Tag5', 'slug' => 'tag_5']);
        $tag6 = Tag::create(['name' => 'Tag6', 'slug' => 'tag_6']);
    }
}
