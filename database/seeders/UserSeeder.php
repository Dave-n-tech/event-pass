<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Grace Adebayo', 'email' => 'grace@example.com', 'email_verified_at' => now(), 'password' => bcrypt('password123'), 'remember_token' => Str::random(10)],
            ['name' => 'Tolu Olamide', 'email' => 'tolu@example.com', 'email_verified_at' => now(), 'password' => bcrypt('password123'), 'remember_token' => Str::random(10),],
            ['name' => 'Samuel Ekene', 'email' => 'samuel@example.com', 'email_verified_at' => now(), 'password' => bcrypt('password123'), 'remember_token' => Str::random(10),],
            ['name' => 'Linda Uche', 'email' => 'linda@example.com', 'email_verified_at' => now(), 'password' => bcrypt('password123'), 'remember_token' => Str::random(10),],
            ['name' => 'Ibrahim Musa', 'email' => 'ibrahim@example.com', 'email_verified_at' => now(), 'password' => bcrypt('password123'), 'remember_token' => Str::random(10),],
        ];

        User::insert($users);
    }
}
