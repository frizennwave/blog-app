<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            BlogSeeder::class,
            NewsSeeder::class,
            ImageSeeder::class,
            RatingSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
