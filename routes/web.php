<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mockup', function () {
    return view('mockup');
});

Route::get('/tentang', function () {
    return view('tentang');
});

// Latihan 1
Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, $nama! Selamat datang di Toko Online.";
});

// Latihan 2
Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
    return "Menampilkan kategori: $nama";
})->name('kategori.detail');

// Latihan 3
Route::get('/produk/{id}', function ($id = 'belum-ada') {
    return "Detail produk dengan ID: $id";
})->name('produk.detail');

