<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Transaksi;
use App\Models\Sertifikat;

class ProfileController extends Controller
{
    public function profile()
    {
        $history = History::where('fk_user', Auth::id())
            ->orderBy('viewed_at', 'desc')
            ->take(3) // Ambil hanya 3 histori terbaru
            ->get();

        return view('user.profile', compact('history'));
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

    public function classHistory()
    {
        $history = History::where('fk_user', Auth::id())->with('cover.mentor')->get();
        return view('user.history.class', compact('history'));
    }

    public function transactionHistory()
    {
        $transactions = Transaksi::where('id_user', Auth::id())->get();
        return view('user.history.transaction', compact('transactions'));
    }

    public function appreciateHistory()
    {
        $certificates = Sertifikat::where('fk_user', Auth::id())->get();
        return view('user.history.appreciate', compact('certificates'));
    }

}
