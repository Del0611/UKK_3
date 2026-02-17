<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Tampilan halaman login
Route::get('/login', function () {
    return view('login');
});

// Proses pengecekan login
Route::post('/login-proses', function (Request $request) {
    $user = DB::table('admin')
        ->where('username', $request->username)
        ->where('password', $request->password) // Cek kecocokan password
        ->first();

    if ($user) {
        // Jika data ada, simpan identitas di session
        Session::put('admin_logged_in', $user->username);
        return redirect('/dashboard');
    } else {
        // Jika salah, balikkan ke login dengan pesan error
        return redirect('/login')->with('error', 'Username atau Password salah!');
    }
});

// Halaman Dashboard (Hanya bisa dibuka jika sudah login)
Route::get('/dashboard', function () {
    if (!Session::has('admin_logged_in')) {
        return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
    }
    return "Selamat Datang, " . Session::get('admin_logged_in') . "! <br> <a href='/logout'>Logout</a>";
});

// Proses Logout
Route::get('/logout', function () {
    Session::forget('admin_logged_in');
    return redirect('/login');
});