<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
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

        User::where('role', 'editor')->get()->each(function ($user) use ($tagIds) {
            $count = rand(1, 5);

            $blogs = Blog::factory()->count($count)->create([
                'user_id' => $user->id,
            ]);

            $blogs->each(function ($blog) use ($tagIds) {
                Comment::factory()->count(5)->create([
                    'blog_id' => $blog->id,
                ]);

                $randomTag = $tagIds->random(rand(1, 3));
                $blog->tags()->attach($randomTag);
            });
        });
    }
}
