<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'adventure', 'hobby', 'food', 'study', 'makeup', 'programming'
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'name' => $tag
            ]);
        }

        $tagIds = Tag::pluck('id');

        Blog::factory(10)->hasComment(5)->create()->each(function ($blog) use ($tagIds) {
            $randomTag = $tagIds->random(rand(1, 3));

            $blog->tags()->attach($randomTag);
        });
    }
}
