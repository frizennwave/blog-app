<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            'Teknologi',
            'Pemrograman',
            'Laravel',
            'Web Development',
            'Tips & Tutorial',
            'Gaya Hidup',
            'Bisnis',
            'Pendidikan',
            'Berita Terkini',
            'Opini',
        ])->map(
            fn(string $name) => Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ])
        );

        Blog::all()->each(function (Blog $blog) use ($categories) {
            $blog->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')
            );
        });

        News::all()->each(function (News $news) use ($categories) {
            $news->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
