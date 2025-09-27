<?php

namespace Database\Factories;

use App\Models\User;
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

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'image_url' => 'https://example.com/default.jpg',
            'image_file' => '',
            'capacity' => $this->faker->numberBetween(20, 200),
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'price' => $this->faker->randomFloat(2, 0, 5000),
        ];
    }
}
