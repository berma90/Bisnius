<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class OauthController extends Controller
{
    // 🔹 Login Manual (Email & Password)
    public function loginManual(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->redirectUser(Auth::user());
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // 🔹 Redirect ke Google OAuth
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    // 🔹 Handle Callback dari Google OAuth
    public function handleProviderCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $findUser = User::where('gauth_id', $googleUser->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'jurusan' => $request->jurusan ?? null,
                    'gauth_id' => $googleUser->id,
                    'gauth_type' => 'google',
                    'role' => 'user', // Default role sebagai user
                    'password' => bcrypt('admin@123'),
                ]);

                Auth::login($newUser);
            }

            return $this->redirectUser(Auth::user());

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }

    // 🔹 Redirect Berdasarkan Role
    private function redirectUser($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.user');
        } else {
            return redirect()->route('home');
        }
    }

    // 🔹 Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
