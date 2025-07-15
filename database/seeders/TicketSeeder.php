<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Event;
use App\Models\User;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0 || Event::count() === 0) {
            $this->call([UserSeeder::class, EventSeeder::class]);
        }

        Ticket::factory()->count(50)->create();
    }
}
