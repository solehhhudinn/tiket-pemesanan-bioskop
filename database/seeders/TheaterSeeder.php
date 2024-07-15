<?php

namespace Database\Seeders;

use App\Models\Theater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theater::create([
            'name' => 'CGV Miko Mall',
            'location' => 'Bandung',
            'price' => '35000',
        ]);
        Theater::create([
            'name' => 'XXI Braga',
            'location' => 'Bandung',
            'price' => '40000',
        ]);
        Theater::create([
            'name' => 'CGV BEC',
            'location' => 'Bandung',
            'price' => '45000',
        ]);
        Theater::create([
            'name' => 'XXI Jatos',
            'location' => 'Bandung',
            'price' => '40000',
        ]);
    }
}
