<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        RoomType::create([
            'name' => 'Single Room',
            'description' => 'Single bed room',
            'price_per_night' => 1500,
            'capacity' => 1,
        ]);

        RoomType::create([
            'name' => 'Double Room',
            'description' => 'Double bed room',
            'price_per_night' => 2500,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name' => 'Deluxe Room',
            'description' => 'Luxury deluxe room',
            'price_per_night' => 5000,
            'capacity' => 4,
        ]);
    }
}