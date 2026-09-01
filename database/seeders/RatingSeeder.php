<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\News;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::query()->each(function (Blog $blog) {
            Rating::factory()
                ->for($blog, 'ratingable')
                ->create();
        });

        News::query()->each(function (News $news) {
            Rating::factory()
                ->for($news, 'ratingable')
                ->create();
        });
    }
}
