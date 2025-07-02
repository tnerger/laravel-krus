<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Nicht vergessen: Die Factory muss noch im Seeder ausgeführt werden: Job::factory(10)->ceate();
        return [
            'title' => fake()->jobTitle,
            'description' => fake()->paragraphs(3, true),
            'salary' => fake()->numberBetween(5_000,150_000),
            'location' => fake()->city,
            'category' => fake()->randomElement(Job::$category),
            'expierience' => fake()->randomElement(Job::$expierience)
        ];
    }
}
