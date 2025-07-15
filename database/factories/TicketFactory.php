<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'event_id' => Event::inRandomOrder()->first()?->id ?? Event::factory(),
            'user-email' => $this->faker->unique()->safeEmail(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'qr_code' => null, // QR code will be generated later
        ];
    }
}
