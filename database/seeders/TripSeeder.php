<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\Day;
use App\Models\Stop;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        $trip1 = Trip::create([
            'title' => 'Viaggio a Roma',
            'description' => 'Visita ai monumenti storici di Roma.',
            'date' => '2024-09-01',
        ]);

        $day1 = $trip1->days()->create([
            'date' => '2024-09-02',
            'description' => 'Visita al Colosseo.',
        ]);

        $day1->stops()->createMany([
            ['name' => 'Colosseo', 'description' => 'Visita al Colosseo.'],
            ['name' => 'Foro Romano', 'description' => 'Visita al Foro Romano.'],
        ]);

        $day2 = $trip1->days()->create([
            'date' => '2024-09-03',
            'description' => 'Visita al Vaticano.',
        ]);

        $day2->stops()->createMany([
            ['name' => 'Basilica di San Pietro', 'description' => 'Visita alla Basilica di San Pietro.'],
            ['name' => 'Musei Vaticani', 'description' => 'Visita ai Musei Vaticani.'],
        ]);

        $trip2 = Trip::create([
            'title' => 'Viaggio a Parigi',
            'description' => 'Tour della città e visita alla Torre Eiffel.',
            'date' => '2024-09-10',
        ]);

        $day3 = $trip2->days()->create([
            'date' => '2024-09-11',
            'description' => 'Visita alla Torre Eiffel.',
        ]);

        $day3->stops()->createMany([
            ['name' => 'Torre Eiffel', 'description' => 'Visita alla Torre Eiffel.'],
            ['name' => 'Champs de Mars', 'description' => 'Passeggiata nei Champs de Mars.'],
        ]);

        $day4 = $trip2->days()->create([
            'date' => '2024-09-12',
            'description' => 'Visita al Louvre.',
        ]);

        $day4->stops()->createMany([
            ['name' => 'Museo del Louvre', 'description' => 'Visita al Museo del Louvre.'],
            ['name' => 'Giardini delle Tuileries', 'description' => 'Passeggiata nei Giardini delle Tuileries.'],
        ]);
    }
}