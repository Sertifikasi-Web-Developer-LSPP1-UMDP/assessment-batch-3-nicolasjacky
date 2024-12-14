<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informasi;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showDaftarMahasiswa()
    {
        // Ambil semua data informasi dan urutkan berdasarkan tanggal
        $informasi = Informasi::orderBy('created_at', 'asc')->get();
        // dd($informasi);
        return view('welcome', compact('informasi')); // Kirim data ke view
    }



}

