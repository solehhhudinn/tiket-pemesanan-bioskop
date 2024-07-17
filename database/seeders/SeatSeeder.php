<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    public function run()
    {
        $seats = [
            // Bangku untuk teater CGV
            ['theater_id' => 1 , 'seat_number' => 'B1', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B2', 'type' => 'regular', 'is_available' => false],
            ['theater_id' => 1 , 'seat_number' => 'B3', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B4', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B5', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B6', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B7', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B8', 'type' => 'regular', 'is_available' => false],
            ['theater_id' => 1 , 'seat_number' => 'B9', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'B10', 'type' => 'regular', 'is_available' => false],
            ['theater_id' => 1 , 'seat_number' => 'A1', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A2', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A3', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A4', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A5', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A6', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A7', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A8', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A9', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 1 , 'seat_number' => 'A10', 'type' => 'sweetbox', 'is_available' => true],

            ['theater_id' => 3 , 'seat_number' => 'B1', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B2', 'type' => 'regular', 'is_available' => false],
            ['theater_id' => 3 , 'seat_number' => 'B3', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B4', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B5', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B6', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B7', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B8', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B9', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'B10', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A1', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A2', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A3', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A4', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A5', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A6', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A7', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A8', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A9', 'type' => 'sweetbox', 'is_available' => true],
            ['theater_id' => 3 , 'seat_number' => 'A10', 'type' => 'sweetbox', 'is_available' => true],

            // Bangku untuk teater XXI
            ['theater_id' => 2 , 'seat_number' => 'A1', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 2 , 'seat_number' => 'A2', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 2 ,'seat_number' => 'A3', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 2 ,'seat_number' => 'A4', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 2 ,'seat_number' => 'A5', 'type' => 'regular', 'is_available' => true],
            ['theater_id' => 2 ,'seat_number' => 'A6', 'type' => 'regular', 'is_available' => true],
        ];

        DB::table('seats')->insert($seats);
    }
}
