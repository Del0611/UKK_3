<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;


//Siswa

Route::get('/admin', function () {
    return view('/admin/login');
});


// Pastikan bagian login menyimpan NIS
Route::post('/login-admin-proses', function (Request $request) {
    $user_admin = DB::table('admin')
        ->where('username', $request->username)
        ->where('password', $request->password)
        ->first();
    
    if ($user_admin) {
        Session::put('admin_logged_in', $user_admin->password);
        Session::put('admin_username', $user_admin->username);
        return redirect('/admin/dashboard');
    } else {
        return redirect('/admin')->with('error', 'Username atau Password salah!');  
    }
});


Route::get('/admin/dashboard', function () {
    // 1. Ambil data aspirasi dengan JOIN
    // Berdasarkan image_d80117.png, kolom kategori di i_aspirasi adalah VARCHAR
    // Kita asumsikan di tabel kategori, kolom penghubungnya juga bernama 'kategori'
$aspirasi = DB::table('i_aspirasi')
        ->join('siswa', 'i_aspirasi.nis', '=', 'siswa.nis')
        // Sesuaikan: i_aspirasi.kategori dihubungkan ke kategori.id_kategori
        ->join('kategori', 'i_aspirasi.id_kategori', '=', 'kategori.id_kategori') 
        ->select(
            'i_aspirasi.*', 
            'siswa.nama', 
            'kategori.ket_kategori' // Kolom dari tabel kategori untuk ditampilkan
        )
        ->get();

    // 2. Ambil semua kategori untuk modal edit
    $kategori = DB::table('kategori')->get();

    // 3. Hitung statistik
    $total_siswa = DB::table('siswa')->count();
    $total_aspirasi = DB::table('i_aspirasi')->count();

    // 4. Data session
    $data = [
        'username' => session('username', 'Admin')
    ];

    return view('admin.dashboard', compact(
        'aspirasi', 
        'kategori', 
        'total_siswa', 
        'total_aspirasi', 
        'data'
    ));
});


// Route untuk Update Aspirasi
Route::post('/admin/aspirasi-update', function (Request $request) {
    DB::table('i_aspirasi')
        ->where('id_pelaporan', $request->id_pelaporan)
        ->update([
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->pesan,
            'status'      => $request->status,
        ]);

    return redirect()->back()->with('success', 'Aspirasi berhasil diperbarui!');
});

// Route untuk Hapus Aspirasi
Route::get('/admin/aspirasi-hapus/{id}', function ($id) {
    DB::table('i_aspirasi')->where('id_pelaporan', $id)->delete();
    return redirect()->back()->with('success', 'Data berhasil dihapus!');
});

// Proses Logout
Route::get('/logout', function () {
    Session::forget('admin_logged_in');
    return redirect('/admin/login');
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
        'id_kategori' => $request->kategori, // Akan menerima angka dari <option value="...">
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