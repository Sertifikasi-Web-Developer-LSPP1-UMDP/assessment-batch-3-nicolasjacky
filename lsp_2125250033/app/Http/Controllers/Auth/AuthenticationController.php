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
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];

        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the new user
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login the user after registration
        // auth()->login($user);


        // Redirect to welcome page
        return redirect()->route('login');
    }


    /**
     * Log in a user.
     */


    public function login(Request $request)
    {
        // Validate the request data
        $rules = [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5',
        ];

        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        // Check if the user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User  not found!'], 404);
        }

        // Check if the password is correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'Password Salah!'], 401);
        }

        // Check if the user is verified
        if ($user->role == 'mahasiswa' && !$user->verified) {
            return response()->json([
                'status' => false,
                'message' => 'Akun anda belum diverifikasi!'
            ]);
        }

        // Generate the authentication token
        $token = $user->createToken('auth_token')->plainTextToken;


        Auth::login($user);
        // Check the user role
        if ($user->role == 'admin') {
            return redirect()->route('admin');
        } elseif ($user->role == 'mahasiswa') {
            return redirect()->route('status-pendaftaran', ['userId' => $user->id]);
        } else {
            return redirect()->route('login');
        }

    }


    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan!',
            ]);
        }

        try {
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus user! ' . $e->getMessage(),
            ]);
        }
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan!',
            ]);
        }

        try {
            $user->restore();

            return response()->json([
                'status' => true,
                'message' => 'User berhasil dikembalikan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengembalikan user! ' . $e->getMessage(),
            ]);
        }
    }

}
