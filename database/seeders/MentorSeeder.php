<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mentor;

class MentorSeeder extends Seeder
{

    public function run(): void
    {
        $tkj = DB::table('jurusans')->where('jurusan', 'TKJ')->first()->id;

        Mentor::create([
            'nama_mentor' => 'Laura Putri',
            'chat' => 'https://t.me/Lauraaputri',
            'id_jurusan' => $tkj,
            'deskripsi' => 'Mentor berpengalaman dalam bidang jaringan komputer.',
            'foto' => 'storage/fotoprofil.jpg'
        ]);
    }
}