<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'title' => 'Deluxe Ocean View Suite',
                'description' => 'Experience luxury with our stunning ocean view suite. Features a king-size bed, private balcony, and breathtaking views of the coastline. Perfect for a romantic getaway or special occasion.',
                'price' => 299.99,
                'capacity' => 2,
                'room_type' => 'deluxe',
                'available' => true,
                'amenities' => 'WiFi, TV, AC, Mini Bar, Ocean View, Balcony, Room Service',
            ],
            [
                'title' => 'Executive Business Suite',
                'description' => 'Ideal for business travelers. Spacious suite with a dedicated work area, high-speed internet, and premium amenities. Located on the executive floor with exclusive access.',
                'price' => 249.99,
                'capacity' => 2,
                'room_type' => 'suite',
                'available' => true,
                'amenities' => 'WiFi, TV, AC, Work Desk, Business Center Access, Room Service',
            ],
            [
                'title' => 'Presidential Suite',
                'description' => 'The ultimate in luxury accommodation. Our presidential suite features a separate living area, dining room, and master bedroom. Includes butler service and premium amenities.',
                'price' => 599.99,
                'capacity' => 4,
                'room_type' => 'presidential',
                'available' => true,
                'amenities' => 'WiFi, TV, AC, Mini Bar, Living Room, Dining Area, Butler Service, Premium Toiletries',
            ],
            [
                'title' => 'Standard Comfort Room',
                'description' => 'Comfortable and well-appointed standard room perfect for short stays. Features all essential amenities and a cozy atmosphere for a restful night.',
                'price' => 129.99,
                'capacity' => 2,
                'room_type' => 'standard',
                'available' => true,
                'amenities' => 'WiFi, TV, AC, Coffee Maker',
            ],
            [
                'title' => 'Family Deluxe Room',
                'description' => 'Spacious room designed for families. Features two queen beds, extra seating area, and family-friendly amenities. Perfect for a comfortable family vacation.',
                'price' => 199.99,
                'capacity' => 4,
                'room_type' => 'deluxe',
                'available' => true,
                'amenities' => 'WiFi, TV, AC, Mini Bar, Extra Beds, Family Amenities',
            ],
            [
                'title' => 'Honeymoon Suite',
                'description' => 'Romantic suite designed for newlyweds. Features a luxurious king bed, jacuzzi, and romantic decor. Includes special honeymoon package amenities.',
                'price' => 349.99,
                'capacity' => 2,
                'room_type' => 'suite',
                'available' => true,
                'amenities' => 'WiFi, TV, AC, Jacuzzi, Romantic Decor, Champagne Service, Room Service',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
