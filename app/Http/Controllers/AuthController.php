<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // memproses login
    public function login(Request $request)
    {
        $akun = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek akun ke database
        if (Auth::attempt($akun)) {

            // membuat session baru
            $request->session()->regenerate();

            return redirect()->route('products.index');
        }

        // jika gagal login
        return back()->withErrors([
            'login_error' => 'email atau password salah'
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}