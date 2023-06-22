<?php

namespace Database\Seeders;

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
            \DB::table('room')->insert([
                'room_number' => $i, 
                'room_type' => $room_type[rand(0,1)],
                'bed' => $bed[rand(0,1)],
                'price' => round(rand(300000, 1000000)),
                'status' => $status[rand(0,2)],
                'maintenance_start' => '2020-01-01 00:00:00',
                'maintenance_end' => '2020-01-01 00:00:00',
            ]);
        }
    }
}
