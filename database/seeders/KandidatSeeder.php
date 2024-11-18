<?php

namespace Database\Seeders;

use App\Models\Kandidat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kandidat::create([
            'name' => 'Indra Udayana',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-1.png',
        ]);
        Kandidat::create([
            'name' => 'Dede Baskara',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-1.png',
        ]);
        Kandidat::create([
            'name' => 'Roby Dwimarta',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-1.png',
        ]);
        Kandidat::create([
            'name' => 'Setiawan Rama',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-1.png',
        ]);
    }
}
