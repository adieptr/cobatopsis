<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpkBukuController;

Route::get('/', function () {
    return view('welcome');
});

// Menampilkan form rekomendasi
Route::get('/form-rekomendasi', [SpkBukuController::class, 'form'])->name('form.rekomendasi');

// Menangani proses rekomendasi setelah form dikirim
Route::post('/proses-rekomendasi', [SpkBukuController::class, 'proses'])->name('proses.rekomendasi');
