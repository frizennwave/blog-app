<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                '1a2b3c4d5e6f7a8b9c0d1e2f3a4b5c6d.jpeg',
                '3c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f.jpeg',
                '7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a.png',
                '9f0e1d2c3b4a5f6e7d8c9b0a1f2e3d4c.jpeg',
                'a8f5c2e91b4d7f3e8a2c1f0d9e4b7a6c.jpg',
                'b4a3c2d1e0f9a8b7c6d5e4f3a2b1c0d9.png',
                'c9d8e7f6a5b4c3d2e1f0a9b8c7d6e5f4.jpg',
                'e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6.jpeg',
                'e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0.jpeg',
                'f23e7a9b0c1d4e5f6a7b8c9d0e1f2a3b.jpg',
            ]),
        ];
    }
}
