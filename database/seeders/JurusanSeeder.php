<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create(['jurusan' => 'Teknik Jaringan Komputer dan Telekomunikasi']);
        Jurusan::create(['jurusan' => 'Multimedia']);
        Jurusan::create(['jurusan' => 'Teknik Kimia']);
        Jurusan::create(['jurusan' => 'Tata Boga']);
    }
}