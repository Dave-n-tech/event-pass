<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\User;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }

        $events = [
            ['user_id' => 1, 'title' => 'Tech Summit 2025', 'description' => 'Annual gathering of tech innovators.', 'location' => 'Lagos', 'image_url' => 'https://media.istockphoto.com/id/1499670337/photo/diverse-audience-listening-closely-to-lively-panel-discussion-at-tech-conference.webp?a=1&b=1&s=612x612&w=0&k=20&c=6D3r30O7eb6KFuwVKRsAvfpOS9Cvl5YdCHKm-tdowvg=', 'image_file' => '', 'capacity' => 150, 'event_date' => '2025-09-12', 'price' => 0],
            ['user_id' => 2, 'title' => 'Fashion Week Lagos', 'description' => 'Runway and design showcase.', 'location' => 'Lagos', 'image_url' => 'https://images.unsplash.com/photo-1605289355680-75fb41239154?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8ZmFzaGlvbiUyMGV2ZW50fGVufDB8fDB8fHww', 'image_file' => '', 'capacity' => 80, 'event_date' => '2025-10-03', 'price' => rand(0, 5000)],
            ['user_id' => 3, 'title' => 'Music Fest 2025', 'description' => 'Live performances by top artists.', 'location' => 'Ibadan', 'image_url' => 'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bXVzaWMlMjBmZXN0fGVufDB8fDB8fHww', 'image_file' => '', 'capacity' => 200, 'event_date' => '2025-11-18', 'price' => rand(0, 5000)],
            ['user_id' => 4, 'title' => 'Startup Pitch Nigeria', 'description' => 'Pitching session for startups.', 'location' => 'Abuja', 'image_url' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cGl0Y2h8ZW58MHx8MHx8fDA%3D', 'image_file' => '', 'capacity' => 100, 'event_date' => '2025-09-25', 'price' => rand(0, 5000)],
            ['user_id' => 5, 'title' => 'AI Conference', 'description' => 'Conference on Artificial Intelligence.', 'location' => 'Port Harcourt', 'image_url' => 'https://plus.unsplash.com/premium_photo-1683121710572-7723bd2e235d?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8QUl8ZW58MHx8MHx8fDA%3D', 'image_file' => '', 'capacity' => 120, 'event_date' => '2025-10-15', 'price' => rand(0, 5000)],
            ['user_id' => 1, 'title' => 'Coding Bootcamp', 'description' => 'Learn to code in 7 days.', 'location' => 'Lagos', 'image_url' => 'https://images.unsplash.com/photo-1531498860502-7c67cf02f657?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Q29kaW5nJTIwYm9vdGNhbXB8ZW58MHx8MHx8fDA%3D', 'image_file' => '', 'capacity' => 40, 'event_date' => '2025-08-20', 'price' => rand(0, 5000)],
            ['user_id' => 2, 'title' => 'Legal Tech Forum', 'description' => 'Intersection of law and technology.', 'location' => 'Benin City', 'image_url' => 'https://plus.unsplash.com/premium_photo-1661551645089-2f0a0112770f?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fExlZ2FsJTIwdGVjaHxlbnwwfHwwfHx8MA%3D%3D', 'image_file' => '', 'capacity' => 60, 'event_date' => '2025-12-05', 'price' => rand(0, 5000)],
            ['user_id' => 3, 'title' => 'Health and Wellness Fair', 'description' => 'Promoting mental and physical well-being.', 'location' => 'Enugu', 'image_url' => 'https://images.unsplash.com/photo-1722974180453-305758503804?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8TWVkaWNhbCUyMGV2ZW50fGVufDB8fDB8fHww', 'image_file' => '', 'capacity' => 90, 'event_date' => '2025-09-30', 'price' => rand(0, 5000)],
            ['user_id' => 4, 'title' => 'Barber Masterclass', 'description' => 'Advance your barbing skills.', 'location' => 'Lagos', 'image_url' => 'https://images.unsplash.com/photo-1552974380-6df376868cda?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fEJhcmJlciUyMG1hc3RlcmNsYXNzfGVufDB8fDB8fHww', 'image_file' => '', 'capacity' => 30, 'event_date' => '2025-08-18', 'price' => rand(0, 5000)],
            ['user_id' => 5, 'title' => 'Public Speaking Workshop', 'description' => 'Learn to own the stage.', 'location' => 'Jos', 'image_url' => 'https://images.unsplash.com/photo-1563807894768-f28bee0d37b6?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fFB1YmxpYyUyMHNwZWFraW5nfGVufDB8fDB8fHww', 'image_file' => '', 'capacity' => 70, 'event_date' => '2025-09-10', 'price' => rand(0, 5000)],
        ];

        Event::insert($events);
    }
}
