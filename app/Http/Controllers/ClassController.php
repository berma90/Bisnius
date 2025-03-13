<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cover;
use App\Models\Jurusan;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $jurusanList = Jurusan::all();
        $search = $request->query('search');
        $selectedJurusan = $request->query('filter');

        $query = Cover::query();

        if ($search) {
            $query->where('judul', 'LIKE', "%{$search}%");
        }

        if ($selectedJurusan) {
            $query->where('fk_jurusan', $selectedJurusan);
        }

        $data = $query->get();

        return view('user.class', compact('data', 'jurusanList', 'selectedJurusan', 'search'));
    }

    public function materi($id)
    {
        $cover = Cover::where('id', $id)->first();
        $materi = Materi::where('fk_cover', $id)->get();
        $quiz = Quiz::where('fk_cover', $id)->get(); // Ambil quiz berdasarkan id_cover

        return view('user.materi', compact('materi', 'quiz', 'cover'));
    }

    public function quiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $soal = Soal::where('fk_quiz', $id)->get();
        return view('quiz.show', compact('quiz', 'soal'));
    }
}
