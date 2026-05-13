<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $single = RoomType::where(
            'name',
            'Single Room'
        )->first();

        $double = RoomType::where(
            'name',
            'Double Room'
        )->first();

        $deluxe = RoomType::where(
            'name',
            'Deluxe Room'
        )->first();

        Room::create([
            'room_type_id' => $single->id,
            'room_number' => '101',
            'is_available' => true,
        ]);

        Room::create([
            'room_type_id' => $single->id,
            'room_number' => '102',
            'is_available' => true,
        ]);

        Room::create([
            'room_type_id' => $double->id,
            'room_number' => '201',
            'is_available' => true,
        ]);

        Room::create([
            'room_type_id' => $double->id,
            'room_number' => '202',
            'is_available' => true,
        ]);

        Room::create([
            'room_type_id' => $deluxe->id,
            'room_number' => '301',
            'is_available' => true,
        ]);
    }
}