<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Daftar;
use App\Models\User;
use App\Models\Informasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index()
    {
        $users = User::where('role', 'mahasiswa')->get();
        $formulirs = Daftar::all();
        $informasis = Informasi::all();

        return view('admin', compact('users', 'formulirs', 'informasis'));
    }

    public function verifikasi(Request $request, $id)
    {
        $user = User::find($id);
        $user->verified = true;
        $user->save();
        return redirect()->back()->with('success', 'Mahasiswa telah diverifikasi!');
    }

    public function batalkanVerifikasi(Request $request, $id)
    {
        $user = User::find($id);
        $user->verified = false;
        $user->save();
        return redirect()->back()->with('success', 'Verifikasi telah dibatalkan!');
    }

    public function terima(Request $request, $id)
    {
        $daftar = Daftar::find($id);
        $daftar->status_pendaftaran = 'diterima';
        $daftar->save();
        return redirect()->back()->with('success', 'Pendaftaran telah diterima!');
    }

    public function tolak(Request $request, $id)
    {
        $daftar = Daftar::find($id);
        $daftar->status_pendaftaran = 'ditolak';
        $daftar->save();
        return redirect()->back()->with('success', 'Pendaftaran telah ditolak!');
    }

    public function pending(Request $request, $id)
    {
        $daftar = Daftar::find($id);
        $daftar->status_pendaftaran = 'pending';
        $daftar->save();
        return redirect()->back()->with('success', 'Pendaftaran masih diproses!');
    }

    public function showUsers()
    {
        $users = User::where('role', 'mahasiswa')->get(); // Ambil semua user dengan role 'mahasiswa'
        return view('adminuser', compact('users'));
    }

    public function showFormulirs()
    {
        $formulirs = Daftar::all(); // Ambil semua formulir
        return view('adminformulir', compact('formulirs'));
    }

    public function showInformasi()
    {
        $informasis = Informasi::all(); // Ambil semua informasi
        return view('admininformasi', compact('informasis'));
    }

}

