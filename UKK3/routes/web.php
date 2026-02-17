<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    // Ambil semua data dari tabel admin
    $dataAdmin = DB::table('admin')->get();

    // Tampilkan data ke layar browser
    return response()->json($dataAdmin);
});