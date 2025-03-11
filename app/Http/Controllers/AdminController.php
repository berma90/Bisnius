<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Jurusan;
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
}
