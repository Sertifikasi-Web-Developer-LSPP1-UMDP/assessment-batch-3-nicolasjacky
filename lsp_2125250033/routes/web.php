<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\API\DaftarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InformasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

// Route::get('/start', function () {
//     return view('welcome');
// })->name('start');

Route::get('/start', [WelcomeController::class, 'showDaftarMahasiswa'])->name('daftar-mahasiswa');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');
Route::get('/login', function () {
    return view('loginuser');
})->name('login');
Route::get('/daftarformulir', function () {
    return view('formulir');
})->name('formulir');

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/verifikasi/{id}', [AdminController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/batalkan-verifikasi/{id}', [AdminController::class, 'batalkanVerifikasi'])->name('batalkan-verifikasi');
    Route::post('/simpan-informasi', [InformasiController::class, 'simpanInformasi'])->name('simpan-informasi');
    Route::get('/edit-informasi/{id}', [InformasiController::class, 'editInformasi'])->name('edit-informasi');
    Route::put('/update-informasi/{id}', [InformasiController::class, 'update'])->name('update-informasi');
    Route::delete('/hapus-informasi/{id}', [InformasiController::class, 'hapusInformasi'])->name('hapus-informasi');
    Route::get('/informasi', [InformasiController::class, 'index'])->name('data-informasi');

    Route::get('/status-pendaftaran/{userId}', [DaftarController::class, 'getStatusPendaftaran'])->name('status-pendaftaran');

    Route::post('/daftar/{id}/terima', [AdminController::class, 'terima']);
    Route::post('/daftar/{id}/tolak', [AdminController::class, 'tolak']);
    Route::post('/daftar/{id}/pending', [AdminController::class, 'pending']);
    Route::post('/daftar-formulir', [DaftarController::class, 'store']);

    Route::get('/admin/user', [AdminController::class, 'showUsers'])->name('admin.user');
    Route::get('/admin/formulir', [AdminController::class, 'showFormulirs'])->name('admin.formulir');
    Route::get('/admin/informasi', [AdminController::class, 'showInformasi'])->name('admin.informasi');
});


Route::post('/submit-daftar', [AuthenticationController::class, 'register']);
Route::post('/login-user', [AuthenticationController::class, 'login']);


// require __DIR__.'/auth.php';
