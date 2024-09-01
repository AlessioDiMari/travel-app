<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        Trip::create([
            'title' => 'Viaggio a Roma',
            'description' => 'Visita ai monumenti storici di Roma.',
            'date' => '2024-09-01',
        ]);

        Trip::create([
            'title' => 'Viaggio a Parigi',
            'description' => 'Tour della città e visita alla Torre Eiffel.',
            'date' => '2024-09-10',
        ]);
    }
}