<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('password'),
            'usertype' => 'admin',
            'phone' => '+1234567890',
        ]);

        // Create Regular User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@hotel.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'phone' => '+1234567891',
        ]);

        // Seed Rooms
        $this->call(RoomSeeder::class);
    }
}
