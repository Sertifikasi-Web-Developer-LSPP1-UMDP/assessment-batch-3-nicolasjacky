<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
        $informasis = Informasi::orderBy('created_at', 'asc')->get();
        return view('data-informasi', compact('informasis'));
     }

     public function simpanInformasi(Request $request)
     {
         // Validasi input
         $validator = Validator::make($request->all(), [
             'judul' => 'required',
             'isi' => 'required',
             'foto' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:5000', // Validasi foto
         ]);

         // Cek apakah ada kesalahan validasi
         if ($validator->fails()) {
             return response()->json([
                 'status' => false,
                 'message' => $validator->errors()->first(),
             ]);
         }

         // Buat objek baru untuk menyimpan informasi
         $informasi = new Informasi();
         $informasi->judul = $request->judul;
         $informasi->isi = $request->isi;

         // Proses upload foto
         if ($request->hasFile('foto')) {
             $file = $request->file('foto');
             $filename = time() . '.' . $file->getClientOriginalExtension();
             $file->move(public_path('uploads'), $filename);
             $informasi->foto = $filename; // Simpan nama file foto
         }

         // Simpan data ke database
         $saved = $informasi->save();

         // Cek apakah data berhasil disimpan
         if (!$saved) {
             return response()->json([
                 'status' => false,
                 'message' => 'Gagal menyimpan data informasi',
             ]);
         }

         // Kembalikan respons JSON yang menunjukkan bahwa data berhasil disimpan
         return redirect()->route('admin.informasi')->with('success', 'Informasi Berhasil Ditambahkan');
     }
     public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image|file|mimes:jpeg,png,jpg,gif|max:5000', // Validasi foto, nullable jika tidak diupload
        ]);

        $informasi = Informasi::find($id);
        $informasi->judul = $request->input('judul');
        $informasi->isi = $request->input('isi');

        // Proses upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($informasi->foto) {
                unlink(public_path('uploads/' . $informasi->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $informasi->foto = $filename; // Simpan nama file foto yang baru
        }

        $informasi->save();
        return redirect()->route('admin.informasi')->with('success', 'Informasi Berhasil Di-Update');
    }

     public function editInformasi($id)
     {
         $informasi = Informasi::find($id);
         return view('edit-informasi', compact('informasi'));
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

