<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room_type = array("Standard", "Deluxe");
        $bed = array("Single", "Double");
        $status = array('available', 'booked', 'maintenance');

        for($i=1; $i <= 50; $i++)
        {
            Room::create([
                'room_number' => $i, 
                'room_type' => $room_type[rand(0,1)],
                'bed' => $bed[rand(0,1)],
                'price' => round(rand(300000, 1000000)),
                'status' => $status[rand(0,2)],
                'maintenance_start' => null,
                'maintenance_end' => null,
            ]);
        }
    }
}
