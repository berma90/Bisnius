<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Materi;
use App\Models\Mentor;

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
    public function tmbhV(Request $request)
    {
        $cover= Cover::all();
        return view('admin.materi.tambahV',compact('cover'));
    }

    public function createV(Request $request)
    {
        $request->validate([
        'judul' => 'required|string|max:255',
        'path' => 'required|url',
        'fk_cover' => 'required|exists:covers,id', // Pastikan cover valid
    ]);

        $materi = new Materi();
        $materi->judul = $request->judul;
        $materi->path = $request->path;
        $materi->fk_cover = $request->fk_cover;

        if ($materi->save()) {
            return redirect()->back()->with('success', 'Video berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data!');
        }
    }


    public function tmbhM(Request $request)
    {
        $jurusan= Jurusan::all();
        return view('admin.materi.addM',compact('jurusan'));
    }
    

    public function createM(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi' => 'nullable|string',
                'mentor' => 'required|string|max:255',
                'fk_mentor' => 'nullable|exists:mentors,id',
                'fk_jurusan' => 'nullable|exists:jurusans,id',
            ]);

            // Upload gambar jika ada
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // Simpan ke database
            $cover = Cover::create([
                'judul' => $request->judul,
                'thumbnail' => $thumbnailPath,
                'deskripsi' => $request->deskripsi,
                'mentor' => $request->mentor,
                'fk_mentor' => $request->fk_mentor,
                'fk_jurusan' => $request->fk_jurusan,
            ]);
            

            return redirect()->route('admin.materi')->with('success', 'Materi berhasil ditambahkan!');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Tampilkan error di browser
        }
    }

    public function editCover($id)
    {
        $covers = Cover::findOrFail($id);
        $jurusan = Jurusan::all(); // Ambil daftar jurusan
        return view('admin.materi.editM', compact('covers', 'jurusan'));
    }

    public function updateM(Request $request, $id)
    {
        $covers = Cover::findOrFail($id);

        // Validasi Input
        $request->validate([
            'judul' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            'mentor' => 'required|string|max:255',
            'fk_mentor' => 'nullable|exists:mentors,id',
            'fk_jurusan' => 'nullable|exists:jurusans,id',
        ]);

        // Simpan Foto Baru (jika ada)
        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada
            if ($covers->thumbnail && Storage::exists('public/' . $covers->thumbnail)) {
                Storage::delete('public/' . $covers->thumbnail);
            }            

            // Simpan foto baru dan simpan path yang benar
            $fotoPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $covers->thumbnail = $fotoPath; // Path yang bisa diakses dari public
        }

        // Simpan data lain
        $covers->judul = $request->judul;
        $covers->mentor = $request->mentor;
        $covers->deskripsi = $request->deskripsi;
        $covers->fk_mentor = $request->fk_mentor;
        $covers->fk_jurusan = $request->fk_jurusan;
        $covers->save();

        return redirect()->route('admin.manageM', $id)->with('success', 'Cover berhasil diperbarui');
    }

    public function editV($id)
    {
        // Ambil data materi berdasarkan ID
        $materis = Materi::findOrFail($id);

        return view('admin.materi.editV', compact('materis'));
    }

    public function updateV(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'path' => 'required|url',
        ]);

        // Ambil data berdasarkan ID
        $materis = Materi::findOrFail($id);

        // Update data
        $materis->update([
            'judul' => $request->judul,
            'path' => $request->path,
        ]);

        return redirect()->route('admin.manageM', ['id' => $id])->with('success', 'Materi berhasil diperbarui!');
    }

    public function deleteV($id)
    {
        // Cari data berdasarkan ID
        $materis = Materi::findOrFail($id);

        // Hapus data
        $materis->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.manageM',$id)->with('success', 'Materi berhasil dihapus!');
    }

    public function deleteM($id)
    {
        // Cari data berdasarkan ID
        $coverz = Cover::findOrFail($id);

        // Hapus data
        $coverz->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.manageM',$id)->with('success', 'Materi berhasil dihapus!');
    }

    public function deleteC($id)
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
        return redirect()->route('admin.materi')->with('success', 'Cover berhasil dihapus!');
    }


    public function indexi()
    {
        $covers = Cover::with('jurusan')->get(); // Mengambil semua data dari tabel covers
        $jumlahMateri = Materi::count();
        return view('admin.materi.data', compact('covers','jumlahMateri'));
    }
    public function indexii($id)
    {
        // Cari data berdasarkan ID yang diklik
        $coverz = Cover::find($id); 
        $jumlahMateri = Materi::count();

        // Jika tidak ditemukan, redirect dengan pesan error
        if (!$coverz) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        $materiV= Materi::all();

        return view('admin.materi.manageM', compact('coverz', 'materiV','jumlahMateri'));
    }

    
}
