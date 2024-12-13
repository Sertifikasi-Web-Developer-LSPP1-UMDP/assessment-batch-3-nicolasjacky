<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{
    use Notifiable, SoftDeletes, HasApiTokens;
    public function register(Request $request)
    {
        // Define validation rules
        $rules = [
            'nama' => 'required|string|max:255|unique:users,nama', // Validasi untuk nama
            'email' => 'required|string|email|max:255|unique:users,email', // Validasi untuk email
            'password' => 'required|string|min:8|confirmed',
        ];

        // Define custom messages
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nama.unique' => 'Nama sudah digunakan oleh pengguna lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];

        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Hanya mengembalikan pesan kesalahan kustom
                ->withInput();
        }

        // Create the new user
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Set a success message in the session
        session()->flash('success', 'Pendaftaran berhasil! Silakan login.');

        // Redirect to login page
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        // Validasi data permintaan
        $rules = [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5',
        ];

        $validator = Validator::make($request->all(), $rules);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Mengembalikan pesan kesalahan
                ->withInput(); // Mengembalikan input sebelumnya
        }

        // Mencari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek jika pengguna tidak ditemukan
        if (!$user) {
            session()->flash('error', 'User tidak ditemukan!');
            return redirect()->back()->withInput();
        }

        // Cek kredensial pengguna
        if (Hash::check($request->password, $user->password)) {
            // Login pengguna
            Auth::login($user);

            // Menghasilkan token
            $token = $user->createToken('YourAppName')->plainTextToken;

            // Set token ke session atau cookie jika diperlukan
            session(['token' => $token]);

            // Set pesan sukses di session
            // session()->flash('success', 'Login berhasil! Selamat datang, ' . $user->nama . '.');

            // Redirect berdasarkan peran pengguna
            if ($user->role == 'admin') {
                return redirect()->route('admin'); // Redirect ke halaman admin
            } elseif ($user->role == 'mahasiswa') {
                return redirect()->route('status-pendaftaran', ['userId' => $user->id]); // Redirect ke halaman mahasiswa
            } else {
                return redirect()->route('login'); // Redirect ke halaman login jika peran tidak dikenali
            }
        } else {
            // Jika password salah
            session()->flash('error', 'Password salah!');
            return redirect()->back()->withInput();
        }
    }


}
