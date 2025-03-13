<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
        'judul' => 'required|string|max:255',
        'path' => 'required|url', // Pastikan cover valid
        ]);

        Materi::create([
            'judul' => $request->judul,
            'path' => $request->path,
            'fk_cover' => $id,
        ]);

        return redirect()->route('admin.materi',['id'=>$id])->with('success', 'Video berhasil disimpan!');
    }


    public function createCover(Request $request)
    {
        $jurusan= Jurusan::all();
        $mentor = Mentor::all();
        return view('admin.cover.add',compact('jurusan','mentor'));
    }


    public function storeCover(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi' => 'nullable|string',
                'fk_mentor' => 'nullable|exists:mentors,id',
                'fk_jurusan' => 'nullable|exists:jurusans,id',
            ]);

            // Upload gambar jika ada
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // Simpan ke database
            Cover::create([
                'judul' => $request->judul,
                'thumbnail' => $thumbnailPath,
                'deskripsi' => $request->deskripsi,
                'fk_mentor' => $request->fk_mentor,
                'fk_jurusan' => $request->fk_jurusan,
            ]);


            return redirect()->route('admin.cover')->with('success', 'Materi berhasil ditambahkan!');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Tampilkan error di browser
        }
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
        $covers = Cover::findOrFail($id);

        // Validasi Input
        $request->validate([
            'judul' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tidak wajib diisi
            'deskripsi' => 'required|string',
            'fk_mentor' => 'required|exists:mentors,id',
            'fk_jurusan' => 'required|exists:jurusans,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada
            if ($covers->thumbnail && file_exists(public_path('storage/' . $covers->thumbnail))) {
                unlink(public_path('storage/' . $covers->thumbnail));
            }

            // Ambil file & buat nama unik
            $file = $request->file('thumbnail');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Simpan file di storage/app/public/thumbnail
            $fotoPath = $file->storeAs('thumbnail', $fileName, 'public');

            // Simpan ke database
            $covers->thumbnail = $fotoPath;
        }

        // Update data lainnya
        $covers->update($request->except(['thumbnail']));

        return redirect()->route('admin.cover', $id)->with('success', 'Cover berhasil diperbarui');
    }


    public function editV($id)
    {
        // Ambil data materi berdasarkan ID
        $materis = Materi::findOrFail($id);

        return view('admin.materi.edit', compact('materis'));
    }

    public function updateV(Request $request, $id)
    {
        // Ambil data berdasarkan ID
        $materis = Materi::findOrFail($id);

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'path' => 'required|url', // Pastikan URL valid
        ]);

        // Update data materi menggunakan objek model, bukan secara statis
        $materis->update([
            'judul' => $request->judul,
            'path' => $request->path,
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
        return view('admin.quiz.add', compact('mentors','covers'));
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'fk_cover' => 'required|integer|exists:covers,id',
            'fk_mentor' => 'required|integer|exists:mentors,id',
        ]);

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
    }

    // Menampilkan form edit soal
    public function editSoal($id)
    {
        $soal = Soal::findOrFail($id);
        return view('admin.soal.edit', compact('soal'));
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
