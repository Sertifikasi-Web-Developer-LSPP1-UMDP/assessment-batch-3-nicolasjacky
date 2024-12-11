<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/start', function () {
    return view('welcome');
});
Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/loginuser', function () {
    return view('loginuser');
})->name('loginuser');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/submit-daftar', [AuthenticationController::class, 'register'])->name('daftarPendaftaran');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
