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
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'image' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4',
            'capacity' => $this->faker->numberBetween(20, 200),
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+6 months'),
            'price' => $this->faker->randomFloat(2, 0, 250),
        ];
    }
}
