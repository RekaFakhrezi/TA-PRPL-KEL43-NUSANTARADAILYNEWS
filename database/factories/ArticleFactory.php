<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id ?? \App\Models\User::factory(),
            'category_id' => \App\Models\Category::all()->random()->id ?? \App\Models\Category::factory(),
            'title' => $this->faker->sentence(rand(6, 10)),
            'content' => collect($this->faker->paragraphs(rand(5, 10)))->map(fn($p) => "<p>$p</p>")->implode(''),
            'status' => $this->faker->randomElement(['approved', 'approved', 'approved', 'pending', 'unpublished']),
            'view_count' => rand(0, 5000),
            'featured' => $this->faker->boolean(10), // 10% featured
            'spotlight' => $this->faker->boolean(15), // 15% spotlight
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
