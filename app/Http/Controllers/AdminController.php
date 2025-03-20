<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Materi;
use App\Models\Mentor;
use App\Models\Transaksi;
use App\Models\Quiz;
use App\Models\Soal;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.user.user');
    }


    public function dataUser()
    {
        $user = User::all(); // Ambil semua data user
        return view('admin.user.data', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil data user berdasarkan ID
        return view('admin.user.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        $user->delete(); // Hapus user dari database

        return redirect()->route('admin.user')->with('warning', 'User berhasil dihapus!');
    }

    public function createMentor()
    {
        $jurusan = Jurusan::all(); // Ambil semua jurusan dari database
        return view('admin.mentor.add', compact('jurusan'));
    }

    public function dataMentor()
    {
        // Ambil data mentor beserta relasi jurusan
        $mentor = Mentor::with('jurusan')->get();

        return view('admin.mentor.data', compact('mentor'));
    }

    public function storeMentor(Request $request)
    {
        $request->validate([
            'nama_mentor' => 'required|string|max:255',
            'chat' => 'nullable|url',
            'id_jurusan' => 'required|integer|exists:jurusans,id',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('mentors', 'public');
        }

        Mentor::create([
            'nama_mentor' => $request->nama_mentor,
            'chat' => $request->chat,
            'id_jurusan' => $request->id_jurusan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil ditambahkan!');
    }

    public function editMentor($id)
    {
        $mentor = Mentor::findOrFail($id);
        $jurusan = Jurusan::all(); // Ambil daftar jurusan
        return view('admin.mentor.edit', compact('mentor', 'jurusan'));
    }

    public function updateMentor(Request $request, $id)
    {
        $mentor = Mentor::findOrFail($id);

        // Validasi Input
        $request->validate([
            'nama_mentor' => 'required|string|max:255',
            'chat' => 'required|url',
            'id_jurusan' => 'required|integer',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan Foto Baru (jika ada)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mentor->foto && Storage::exists('public/' . $mentor->foto)) {
                Storage::delete('public/' . $mentor->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('mentor', 'public');
            $mentor->foto = $fotoPath;
        }

        // Simpan data lain
        $mentor->nama_mentor = $request->nama_mentor;
        $mentor->chat = $request->chat;
        $mentor->id_jurusan = $request->id_jurusan;
        $mentor->deskripsi = $request->deskripsi;
        $mentor->save();

        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil diperbarui');
    }


    public function mentorDestroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();

        return redirect()->route('admin.mentor')->with('warning', 'Mentor berhasil dihapus!');
    }

    public function createMateri($id)
    {
        $cover= Cover::findOrFail($id);
        return view('admin.materi.add',compact('cover', 'id'));
    }

    public function storeMateri(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'path' => 'required|url',
        ]);

        // Cek apakah materi dengan judul yang sama sudah ada dalam fk_cover yang sama
        if (Materi::where('judul', trim($request->judul))->where('fk_cover', $id)->exists()) {
            return redirect()->back()->withInput()->with('error', 'Materi dengan judul tersebut sudah ada!');
        }

        // Simpan data materi baru
        Materi::create([
            'judul' => trim($request->judul),
            'deskripsi' => $request->deskripsi,
            'fk_cover' => $id,
            'path' => $request->path,
        ]);

        $materi = Materi::where('fk_cover', $id)->get();
        $cover = Cover::find($id); // Ambil data cover terkait

        return view('admin.materi.data', [
            'materi' => $materi,
            'cover' => $cover,
            'success' => 'Video berhasil disimpan!'
        ]);
    }

    public function createCover(Request $request)
    {
        $jurusan= Jurusan::all();
        $mentor = Mentor::all();
        return view('admin.cover.add',compact('jurusan','mentor'));
    }


    public function storeCover(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255|unique:covers,judul',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            'fk_mentor' => 'required|integer|exists:mentors,id',
            'fk_jurusan' => 'required|integer|exists:jurusans,id',
        ]);

        // Simpan gambar jika diunggah
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Simpan data cover baru
        $cover = Cover::create([
            'judul' => $request->judul,
            'thumbnail' => $thumbnailPath,
            'fk_mentor' => $request->fk_mentor,
            'fk_jurusan' => $request->fk_jurusan,
        ]);

        // Mengambil semua data covers untuk ditampilkan di view
        $covers = Cover::with(['mentor', 'jurusan'])->get();

        return view('admin.cover.data', compact('covers'))->with('success', 'Cover berhasil ditambahkan.');
    }

    public function editCover($id)
    {
        $covers = Cover::findOrFail($id);
        $jurusan = Jurusan::all(); // Ambil daftar jurusan
        $mentor = Mentor::all();
        return view('admin.cover.edit', compact('covers', 'jurusan','mentor'));
    }

    public function updateM(Request $request, $id)
    {
        try {
            $cover = Cover::findOrFail($id);

            // Validasi input dari form
            $request->validate([
                'judul' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional

                'fk_mentor' => 'required|exists:mentors,id',
                'fk_jurusan' => 'required|exists:mentors,id',
            ]);

            // Cek apakah judul cover dengan fk_jurusan yang sama sudah ada
            $cekCover = Cover::where('judul', $request->judul)
                            ->where('fk_jurusan', $request->fk_jurusan)
                            ->where('id', '!=', $id) // Pastikan bukan dirinya sendiri
                            ->exists();

            if ($cekCover) {
                return redirect()->back()->withInput()->with('error', 'Judul cover sudah ada dalam sistem!');
            }

            // Simpan thumbnail baru jika diunggah
            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama jika ada
                if ($cover->thumbnail && Storage::disk('public')->exists($cover->thumbnail)) {
                    Storage::disk('public')->delete($cover->thumbnail);
                }

                // Simpan thumbnail baru
                $fileName = time() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnailPath = $request->file('thumbnail')->storeAs('thumbnails', $fileName, 'public');

                $cover->thumbnail = $thumbnailPath;
            }

            // Perbarui data cover
            $cover->update([
                'judul' => $request->judul,
                'fk_mentor' => $request->fk_mentor,
                'fk_jurusan' => $request->fk_jurusan,
            ]);

            $cover->save();

            return redirect()->route('cover.index')->with('success', 'Cover berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editV($id)
    {
        // Ambil data materi berdasarkan ID
        $materis = Materi::findOrFail($id);

        return view('admin.materi.edit', compact('materis'));
    }

    public function updateV(Request $request, $id)
    {
        // Ambil data materi berdasarkan ID
        $materis = Materi::findOrFail($id);

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'path' => 'required|url', // Pastikan URL valid
        ]);

        // Cek apakah ada materi lain dengan judul yang sama dalam fk_cover yang sama
        $cekMateri = Materi::where('judul', trim($request->judul))
                            ->where('fk_cover', $materis->fk_cover)
                            ->where('id', '!=', $id) // Kecuali dirinya sendiri
                            ->exists();

        if ($cekMateri) {
            return redirect()->back()->withInput()->with('error', 'Materi dengan judul tersebut sudah ada!');
        }

        // Update data materi
        $materis->update([
            'judul' => trim($request->judul),
            'deskripsi' => $request->deskripsi,
            'path'  => $request->path,
        ]);

        return redirect()->route('admin.materi', ['id' => $materis->fk_cover])
            ->with('success', 'Video berhasil diperbarui!');
    }

    public function deleteV($id)
    {
        // Cari data berdasarkan ID
        $materis = Materi::findOrFail($id);

        // Hapus data
        $materis->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.materi',$id)->with('success', 'Materi berhasil dihapus!');
    }

    public function deleteM($id)
    {
        // Cari data berdasarkan ID
        $coverz = Cover::findOrFail($id);

        // Hapus data
        $coverz->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.materi',$id)->with('success', 'Materi berhasil dihapus!');
    }

    public function deleteCover($id)
    {
        // Debug ID sebelum query
        if (!$id) {
            return redirect()->route('admin.materi')->with('error', 'ID tidak valid!');
        }

        // Cari data berdasarkan ID
        $cover = Cover::where('id', $id)->firstOrFail();

        // Hapus gambar jika ada
        if ($cover->thumbnail && Storage::exists('public/' . $cover->thumbnail)) {
            Storage::delete('public/' . $cover->thumbnail);
        }

        // Hapus data dari database
        $cover->delete();

        // Redirect tanpa ID
        return redirect()->route('admin.cover')->with('success', 'Cover berhasil dihapus!');
    }


    public function dataCover()
    {
        $covers = Cover::with('jurusan','materi','mentor')->get();
        return view('admin.cover.data', compact('covers'));
    }

    public function dataMateri($id)
    {
        // Cari data berdasarkan ID yang diklik
        $cover = Cover::with('materi', 'jurusan')->findOrFail($id);

        // Jika tidak ditemukan, redirect dengan pesan error
        if (!$cover) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        return view('admin.materi.data', compact('cover'));
    }

    public function seeMen(){
        $mentors=Mentor::all();

        return view('user.mentor', compact('mentors'));
    }

    public function transaksi() {
        $transaksi = Transaksi::all(); // Ambil semua data dari tabel transaksi
        return view('admin.transaksi', compact('transaksi')); // Kirim data ke view
    }

    public function dataQuiz()
    {
        $quizzes = Quiz::with('cover', 'mentor')->get();
        return view('admin.quiz.data', compact('quizzes'));
    }

    public function createQuiz()
    {
        $mentors = Mentor::all();
        $covers = Cover::all();

        return view('admin.quiz.add', compact( 'mentors', 'covers'));
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'fk_cover' => 'required|integer|exists:covers,id',
            'fk_mentor' => 'required|integer|exists:mentors,id',
        ]);

        $cekquiz = Quiz::where('judul', $request->judul)->first();
        if ($cekquiz) {
            return redirect()->back()->with('error', 'Nama quiz sudah ada!')->withInput();
        }

        Quiz::create([
            'judul' => $request->judul,
            'fk_cover' => $request->fk_cover,
            'fk_mentor' => $request->fk_mentor
        ]);

        return redirect()->route('admin.quiz')->with('success', 'Quiz berhasil ditambahkan!');
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $mentors = Mentor::all();
        $covers = Cover::all();
        return view('admin.quiz.edit', compact('quiz', 'mentors', 'covers'));
    }

    public function updateQuiz(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'fk_cover' => 'required|integer|exists:covers,id',
            'fk_mentor' => 'required|integer|exists:mentors,id',
        ]);

        $cekquiz = Quiz::where('judul', $request->judul)->first();
        if ($cekquiz) {
            return redirect()->back()->with('error', 'Nama quiz sudah ada!')->withInput();
        }

        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());

        return redirect()->route('admin.soal',['id' => $id])->with('success', 'Quiz berhasil diperbarui!');
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('admin.quiz')->with('success', 'Quiz berhasil dihapus!');
    }
    public function dataSoal($id)
    {
        $quiz = Quiz::with('soal', 'cover', 'mentor')->findOrFail($id);
        return view('admin.soal.data', compact('quiz',));
    }

    public function createSoal($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.soal.add', compact('quiz','id'));
    }
    public function storeSoal(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'pilihan1' => 'required',
            'pilihan2' => 'required',
            'pilihan3' => 'required',
            'pilihan4' => 'required',
            'correct' => 'required|in:' . implode(',', [
                $request->pilihan1,
                $request->pilihan2,
                $request->pilihan3,
                $request->pilihan4
            ]),
        ]);

        try {
            Soal::create([
                'fk_quiz' => $id,
                'pertanyaan' => $request->pertanyaan,
                'pilihan1' => $request->pilihan1,
                'pilihan2' => $request->pilihan2,
                'pilihan3' => $request->pilihan3,
                'pilihan4' => $request->pilihan4,
                'correct' => $request->correct,
            ]);

            return redirect()->route('admin.soal', ['id' => $id])->with('success', 'Soal berhasil ditambahkan!');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { // Error code untuk duplicate entry
                return redirect()->back()->with('error', 'Pertanyaan ini sudah ada dalam quiz ini!')->withInput();
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan soal!')->withInput();
        }
    }


    // Menampilkan form edit soal
    public function editSoal($id)
    {
        $soal = Soal::findOrFail($id);
        $quiz = Quiz::findOrFail($soal->fk_quiz);
        return view('admin.soal.edit', compact('soal','quiz'));
    }

    // Menyimpan perubahan soal
    public function updateSoal(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan1' => 'required|string',
            'pilihan2' => 'required|string',
            'pilihan3' => 'required|string',
            'pilihan4' => 'required|string',
            'correct' => 'required|string|in:' . implode(',', [
                $request->pilihan1,
                $request->pilihan2,
                $request->pilihan3,
                $request->pilihan4
            ]),
        ]);

        $soal = Soal::findOrFail($id);
        $soal->update($request->all());

        return redirect()->route('admin.soal', ['id' => $soal->fk_quiz])
            ->with('success', 'Soal berhasil diperbarui!');
    }

    // Menghapus soal
    public function deleteSoal($id)
    {
        $soal = Soal::findOrFail($id);
        $quiz_id = $soal->fk_quiz;
        $soal->delete();

        return redirect()->route('admin.soal', ['id' => $quiz_id])->with('success', 'Soal berhasil dihapus!');
    }
}
