<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $informasis = Informasi::all();
         return view('data-informasi', compact('informasis'));
     }

     public function simpanInformasi(Request $request)
     {
         $request->validate([
             'judul' => 'required',
             'isi' => 'required',
         ]);

         $informasi = new Informasi();
         $informasi->judul = $request->judul;
         $informasi->isi = $request->isi;
         $informasi->save();
         return redirect()->back()->with('success', 'Informasi Berhasil Disimpan!');
     }

     public function editInformasi($id)
     {
         $informasi = Informasi::find($id);
         return view('edit-informasi', compact('informasi'));
     }

     public function update(Request $request, $id)
     {
         $request->validate([
             'judul' => 'required',
             'isi' => 'required',
         ]);

         $informasi = Informasi::find($id);
         $informasi->judul = $request->input('judul');
         $informasi->isi = $request->input('isi');
         $informasi->save();
         return redirect()->route('admin.informasi')->with('success', 'Informasi Berhasil Di-Update');
     }

     public function hapusInformasi($id)
     {
         try {
             $informasi = Informasi::find($id);
             $informasi->delete();
             return redirect()->back()->with('success', 'Informasi Berhasil Dihapus!');
         } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Gagal Menghapus Informasi!');
         }
     }

}

