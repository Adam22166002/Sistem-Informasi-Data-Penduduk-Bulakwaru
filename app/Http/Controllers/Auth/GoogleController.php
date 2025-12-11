<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    // redirect ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // callback dari Google
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google.');
        }

        // cek apakah email sudah ada di database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // jika tidak ingin auto-register → tolak login
            return redirect('/login')->with('error', 'Email tidak terdaftar di sistem.');
        }

        // jika email ditemukan → login
        Auth::login($user);

        return redirect()->intended('home');
    }
}
