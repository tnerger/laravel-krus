<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('en_US');
        return [
            'name' => ucfirst($faker->catchPhrase()) . ' ' . $faker->randomElement(['Summit', 'Conference', 'Expo', 'Workshop']),
            'description' => $faker->catchPhrase() . '. Perfect for your ' . $faker->bs() . '.',
            'start_time' => $faker->dateTimeBetween('now', '+1 month'),
            'end_time' => $faker->dateTimeBetween('+1 month', '+2 months')
        ];
    }
}
