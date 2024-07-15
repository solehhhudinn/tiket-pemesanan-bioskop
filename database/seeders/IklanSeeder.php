<?php

namespace Database\Seeders;

use App\Models\Iklan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IklanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Iklan::create([
            'title' => 'Dilan 1993',
            'iklan' => 'img/iklan-dilan.jpg',
        ]);

        Iklan::create([
            'title' => 'Ipar Adalah Maut',
            'iklan' => 'img/iklan-ipar.jpg',
        ]);

        Iklan::create([
            'title' => 'Inside Out 2',
            'iklan' => 'img/iklan-inside.jpg',
        ]);

        Iklan::create([
            'title' => 'Bad Boys',
            'iklan' => 'img/iklan-badboys.jpg',
        ]);
    }
}
