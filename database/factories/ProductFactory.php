<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(4, true);
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'price' => fake()->randomFloat(2, 0, 100),
            'inventory' => fake()->randomNumber(2),
            'user_id' => fake()->randomElement(User::all())['id'],
        ];
    }
}
