<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    // Mengarahkan user ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menangani kembalian data dari Google setelah user berhasil login
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Cek apakah user dengan email tersebut sudah ada di database
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Jika belum ada, buat akun baru secara otomatis
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // Password acak yang aman
                    'role' => 'user', // Set sebagai user biasa (bukan admin)
                ]);
            }

            // Login-kan user ke dalam aplikasi
            Auth::login($user);

            // Redirect ke halaman utama (home) setelah berhasil login
            return redirect()->route('home')->with('success', 'Berhasil login dengan Google!');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
}