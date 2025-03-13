<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('user.profileU', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'jurusan' => 'required|string',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Pastikan instance dari User
        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'User tidak ditemukan!');
        }

        // Update data user
        $user->update([
            'name' => $request->name,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatedtr(Request $request)
    {
        $request->validate([
            'no_telepon' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,Tidak ingin mengungkapkan'
        ]);

        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        $user->update([
            'no_telepon' => $request->no_telepon,
            'tgl_lahir' => $request->tgl_lahir,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

}
