<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

// Tampilan halaman login
Route::get('/login', function () {
    return view('/admin/login');
})->name('login');

// Proses pengecekan login
Route::post('/login-proses', function (Request $request) {
    // Gunakan pengecekan sederhana (pastikan tabel 'admin' sudah ada di DB)
    $user = DB::table('admin')
        ->where('username', $request->username)
        ->where('password', $request->password)
        ->first();

    if ($user) {
        Session::put('admin_logged_in', $user->username);
        return redirect('/admin/dashboard');
    } else {
        return redirect('/login')->with('error', 'Username atau Password salah!');
    }
});

// Halaman Dashboard (Memanggil View)
Route::get('/admin/dashboard', function () {
    if (!Session::has('admin_logged_in')) {
        return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
    }
    
    // Mengambil data dari session untuk dikirim ke view
    $data = [
        'username' => Session::get('admin_logged_in')
    ];

    return view('/admin/dashboard', compact('data'));
});

// Proses Logout
Route::get('/logout', function () {
    Session::forget('admin_logged_in');
    return redirect('/login');
});


//Siswa

Route::get('/siswa', function () {
    return view('/siswa/login');
});



// Pastikan bagian login menyimpan NIS
Route::post('/login-siswa-proses', function (Request $request) {
    $user_siswa = DB::table('siswa')
        ->where('nis', $request->username)
        ->where('nama', $request->password)
        ->first();
    
    if ($user_siswa) {
        Session::put('siswa_logged_in', $user_siswa->nama);
        Session::put('siswa_nis', $user_siswa->nis); // Simpan NIS untuk id pelaporan
        return redirect('/siswa/dashboard');
    } else {
        return redirect('/siswa')->with('error', 'NIS atau Nama salah!');  
    }
});

// Proses Simpan Aspirasi
Route::post('/aspirasi-simpan', function (Request $request) {
    if (!Session::has('siswa_logged_in')) {
        return redirect('/siswa')->with('error', 'Silahkan login kembali');
    }

    DB::table('i_aspirasi')->insert([
        'kategori' => $request->kategori, // Akan menerima angka dari <option value="...">
        'lokasi'      => 'Sekolah',          // Kamu bisa tambah input lokasi jika perlu
        'nis'         => Session::get('siswa_nis'),
        'ket'         => $request->pesan,
        'created_at'  => now()
    ]);

    return redirect()->back()->with('success', 'Aspirasi berhasil dikirim!');
});

// Update Dashboard agar Riwayat Dinamis
Route::get('/siswa/dashboard', function () {
    if (!Session::has('siswa_logged_in')) {
        return redirect('/siswa');
    }
    
    $data = [
        'username' => Session::get('siswa_logged_in')
    ];

    // Ambil riwayat asli dari database berdasarkan NIS siswa yang login
    $riwayat = DB::table('i_aspirasi')
                ->where('nis', Session::get('siswa_nis'))
                ->orderBy('created_at', 'desc')
                ->get();

    return view('/siswa/dashboard', compact('data', 'riwayat'));
});

// Proses Logout
Route::get('/logout-siswa', function () {
    Session::forget('siswa_logged_in');
    Session::forget('siswa_nis');
    return redirect('/siswa');
});