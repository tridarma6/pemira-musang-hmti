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
            'name' => 'I Made Indra Udayana Wiguna',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-1.png',
        ]);
        Kandidat::create([
            'name' => 'I Gusti Bagus Davin Dharma Ditya',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-2.png',
        ]);
        Kandidat::create([
            'name' => 'I Made Arya Adi Permana',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-3.png',
        ]);
        Kandidat::create([
            'name' => 'Setiawan Rama Putra',
            'suara' => 0,
            'image' => '/assets/images/calon/kandidat-4.png',
        ]);
    }
}
