<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cover;
use App\Models\Jurusan;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\History;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $jurusanList = Jurusan::all();
        $search = $request->query('search');
        $selectedJurusan = $request->query('filter');

        $data = Cover::query()
            ->when($search, fn($q) => $q->where('judul', 'LIKE', "%{$search}%"))
            ->when($selectedJurusan, fn($q) => $q->where('fk_jurusan', $selectedJurusan))
            ->get();

        return view('user.class', compact('jurusanList', 'search', 'selectedJurusan', 'data'));
    }

    public function materi($id)
    {
        $cover = Cover::findOrFail($id);
        $materi = Materi::where('fk_cover', $id)->get();
        $quiz = Quiz::where('fk_cover', $id)->get();

        foreach ($materi as $item) {
            $item->embedUrl = $this->convertToEmbedUrl($item->path);
        }

        // Simpan history jika user sudah login
        if (Auth::check()) {
            // Simpan atau perbarui histori
            History::updateOrCreate(
                ['fk_user' => Auth::id(), 'fk_cover' => $id],
                ['viewed_at' => now()]
            );

            // Ambil histori terbaru (maksimal 3)
            $userHistories = History::where('fk_user', Auth::id())
                ->orderBy('viewed_at', 'desc')
                ->get();

            // Jika lebih dari 3, hapus yang paling lama
            if ($userHistories->count() > 3) {
                $userHistories->slice(3)->each->delete();
            }
        }

        return view('user.materi', compact('materi', 'quiz', 'cover'));
    }

    private function convertToEmbedUrl($url)
    {
        if (strpos($url, 'youtu.be') !== false) {
            $videoId = explode("/", parse_url($url, PHP_URL_PATH))[1];
            return "https://www.youtube.com/embed/" . $videoId;
        } elseif (strpos($url, 'watch?v=') !== false) {
            return str_replace("watch?v=", "embed/", $url);
        }
        return $url;
    }
}
