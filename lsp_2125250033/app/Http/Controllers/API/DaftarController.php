<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Daftar;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $daftar = Daftar::where('user_id', $user->id)->first();
        $informasi = Informasi::all(); // Ambil semua informasi

        $status_pendaftaran = null;

        if ($daftar) {
            $status_pendaftaran = $daftar->status_pendaftaran;
            return view('formulir', compact('status_pendaftaran', 'informasi'));
        } else {
            return view('daftar', compact('informasi', 'status_pendaftaran')); // Kirimkan status_pendaftaran ke view
        }
    }

    public function getStatusPendaftaran($userId)
    {
        // Ambil status pendaftaran berdasarkan userId
        $daftar = Daftar::where('user_id', $userId)->first();

        // Ambil semua informasi
        $informasi = Informasi::all();

        // Cek apakah pengguna yang sedang login adalah pengguna yang diminta
        $user = Auth::user();
        if ($user->id !== (int)$userId) {
            return abort(403, 'Unauthorized access.');
        }

        // Cek apakah akun pengguna telah diverifikasi
        if (!$user->verified) { // Asumsikan ada kolom is_verified di tabel users
            return view('loginuser', ['error' => 'Akun Anda belum diverifikasi.']);
        }

        if ($daftar) {
            $status_pendaftaran = $daftar->status_pendaftaran;
            // Kembalikan status pendaftaran ke view
            return view('formulir', compact('status_pendaftaran', 'informasi'));
        } else {
            // Tangani jika tidak ada data pendaftaran
            $status_pendaftaran = null;
            return view('formulir', compact('status_pendaftaran', 'informasi'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // di dalam controller
    public function store(Request $request)
    {
        // Validasi form
        $validatedData = $request->validate([
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
        ]);

        if($validatedData){
            // Cek apakah pengguna sudah login
            if (Auth::check()) {
                // Cek apakah pengguna sudah mendaftar
                $daftar = Daftar::where('user_id', Auth::user()->id)->first();
                if ($daftar) {
                    // Redirect ke halaman formulir dengan pesan error
                    return redirect()->route('start')->with('error', 'Anda sudah mendaftar sebelumnya!');
                } else {
                    // Simpan data ke database
                    $daftar = new Daftar();
                    $daftar->nama_lengkap = $validatedData['nama_lengkap'];
                    $daftar->jenis_kelamin = $validatedData['jenis_kelamin'];
                    $daftar->tempat_lahir = $validatedData['tempat_lahir'];
                    $daftar->tanggal_lahir = $validatedData['tanggal_lahir'];
                    $daftar->agama = $validatedData['agama'];
                    $daftar->user_id = Auth::user()->id;
                    $daftar->save();

                    // Redirect ke halaman formulir dengan status pendaftaran
                    $status_pendaftaran = 'pending'; // Anda dapat mengganti status pendaftaran sesuai dengan kebutuhan
                    $informasi = Informasi::all();
                    return view('formulir', compact('status_pendaftaran', 'informasi'))->with('success', 'Data berhasil disimpan!');
                }
            } else {
                // Redirect ke halaman login jika pengguna belum login
                return redirect()->route('login');
            }
        }else{
            $errors = $request->session()->get('errors');
            return redirect()->route('start')->withErrors($errors)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Daftar $daftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Daftar $daftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Daftar $daftar)
    {
        //
    }
}
