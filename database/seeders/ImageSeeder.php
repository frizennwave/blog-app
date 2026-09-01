<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->each(function (User $user) {
            Image::factory()
                ->for($user, 'imageable')
                ->create();
        });

        Blog::query()->each(function (Blog $blog) {
            Image::factory()
                ->for($blog, 'imageable')
                ->create();
        });
    }
}
