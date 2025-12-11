<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!\App\Models\User::where('email', $request->email)->exists()) {
            return redirect()->route('register')->with('status', 'Email belum terdaftar, silakan daftar terlebih dahulu.');
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('Email atau password salah.'),
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // kode akses
        if ($user->access_code !== $request->access_code) {
            Auth::logout();
            return back()->withErrors([
                'access_code' => 'Kode akses salah. Silahkan Menghubungi Admin!',
            ])->withInput();
        }
        if ($user->status !== 'active') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda tidak aktif. Silahkan Hubungi Admin!',
            ])->withInput();
        }

        if ($user->hasRole('admin')) {
            return redirect()->intended('dashboard');
        } elseif ($user->hasRole('user')) {
            return redirect()->intended('home');
        }

        return redirect('/');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
