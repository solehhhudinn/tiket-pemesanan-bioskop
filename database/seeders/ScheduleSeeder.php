<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data schedules dengan waktu penayangan
        $schedules = [
            [
                'movie_id' => 1, // ID film pertama
                'theater_id' => 1, // ID teater pertama
                'start_date' => '2024-07-15', // Tanggal penayangan
                'end_date' => '2024-07-30',
                'times' => [
                    ['time' => '14:00:00'], // Jam penayangan pertama
                    ['time' => '17:00:00'], // Jam penayangan kedua
                    ['time' => '20:00:00'], // Jam penayangan ketiga
                ],
            ],
            [
                'movie_id' => 1, // ID film pertama
                'theater_id' => 2, // ID teater kedua
                'start_date' => '2024-07-15', // Tanggal penayangan
                'end_date' => '2024-07-30',
                'times' => [
                    ['time' => '14:00:00'], // Jam penayangan pertama
                    ['time' => '17:00:00'], // Jam penayangan kedua
                ],
            ],
            [
                'movie_id' => 2, // ID film kedua
                'theater_id' => 3, // ID teater ketiga
                'start_date' => '2024-07-14', // Tanggal penayangan
                'end_date' => '2024-07-30',
                'times' => [
                    ['time' => '14:00:00'], // Jam penayangan pertama
                    ['time' => '17:00:00'], // Jam penayangan kedua
                ],
            ],
            [
                'movie_id' => 2, // ID film kedua
                'theater_id' => 4, // ID teater keempat
                'start_date' => '2024-07-14', // Tanggal penayangan
                'end_date' => '2024-07-15',
                'times' => [
                    ['time' => '20:00:00'], // Jam penayangan ketiga
                ],
            ],
            [
                'movie_id' => 3, // ID film ketiga
                'theater_id' => 1, // ID teater pertama
                'start_date' => '2024-07-16', // Tanggal penayangan
                'end_date' => '2024-07-30',
                'times' => [
                    ['time' => '14:00:00'], // Jam penayangan pertama
                    ['time' => '17:00:00'], // Jam penayangan kedua
                    ['time' => '20:00:00'], // Jam penayangan ketiga
                ],
            ],
            [
                'movie_id' => 4, // ID film keempat
                'theater_id' => 2, // ID teater kedua
                'start_date' => '2024-07-16', // Tanggal penayangan
                'end_date' => '2024-07-30',
                'times' => [
                    ['time' => '14:00:00'], // Jam penayangan pertama
                    ['time' => '17:00:00'], // Jam penayangan kedua
                ],
            ],
            [
                'movie_id' => 4, // ID film keempat
                'theater_id' => 4, // ID teater keempat
                'start_date' => '2024-07-16', // Tanggal penayangan
                'end_date' => '2024-07-30',
                'times' => [
                    ['time' => '14:00:00'], // Jam penayangan ketiga
                    ['time' => '17:00:00'], // Jam penayangan keempat
                ],
            ],
        ];

        foreach ($schedules as $scheduleData) {
            Schedule::create($scheduleData);
        }
    }
}
