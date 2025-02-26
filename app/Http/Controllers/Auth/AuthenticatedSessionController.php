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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->roletype === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        elseif ($user->roletype === 'kepala') {
            return redirect()->route('kepala.dashboard');
        }
        elseif ($user->roletype === 'pegawai') {
            return redirect()->route('pegawai.dashboard');
        }

        return redirect()->route('dashboard'); // Default redirect jika role tidak dikenali
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
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
