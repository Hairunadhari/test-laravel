<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function submit(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/admin')->with('success', 'Berhasil Login.');;
        }

        return back()->with(['pesan' => 'Email atau password salah']);
        
    }

    // Menampilkan halaman dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
