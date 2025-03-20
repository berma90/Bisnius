<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Mentor;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $jurusanList = Jurusan::all();
        $search = $request->query('search');
        $selectedJurusan = $request->query('filter');

        $mentors = Mentor::query()
            ->when($search, fn($q) => $q->where('nama_mentor', 'LIKE', "%{$search}%"))
            ->when($selectedJurusan, fn($q) => $q->where('id_jurusan', $selectedJurusan))
            ->with('jurusan')
            ->get();

        return view('user.mentor', compact('mentors', 'jurusanList', 'search', 'selectedJurusan'));
    }
}
