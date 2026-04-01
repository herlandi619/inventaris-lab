<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard', absolute: false));
    // }

    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     $user = $request->user();

    //     if ($user->role == 'laboran') {
    //         return redirect()->route('laboran.dashboard');
    //     }

    //     if ($user->role == 'mahasiswa') {
    //         return redirect()->route('mahasiswa.dashboard');
    //     }

    //     return redirect()->route('laboran.dashboard');
    // }


    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Coba autentikasi user
            $request->authenticate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika gagal autentikasi (email/password salah)
            return back()->withErrors([
                'email' => 'Email atau password Anda salah.',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        $user = $request->user();

        // Cek apakah akun aktif
        if ($user->is_active == 0) {
            // Logout user sekaligus hapus session
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Akun Anda belum diaktifkan. Silakan hubungi laboran.',
            ])->withInput($request->only('email'));
        }

        // Redirect berdasarkan role
        if ($user->role == 'laboran') {
            return redirect()->route('laboran.dashboard');
        }

        if ($user->role == 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }

        // Default fallback
        return redirect()->route('laboran.dashboard');
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
