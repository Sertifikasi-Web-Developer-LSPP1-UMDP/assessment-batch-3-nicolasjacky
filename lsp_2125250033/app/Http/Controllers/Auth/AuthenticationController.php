<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{
    use Notifiable, SoftDeletes;
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
        return response()->json([
            'status' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    try {
        // Create new user
        $user = User::create([
            'nama' => $request->nama,  // Ensure 'nama' field is correctly passed to User model
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Success response
        return response()->json([
            'status' => true,
            'message' => 'Pendaftaran Berhasil!',
            'user' => $user,
        ]);
    } catch (\Exception $e) {
        // Error handling
        return response()->json([
            'status' => false,
            'message' => 'Pendaftaran Gagal! ' . $e->getMessage(),
        ]);
    }
}


    /**
     * Log in a user.
     */


    public function login(Request $request)
    {
        // Validate the request data
        $rules = [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        // Check if the user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found!'], 404);
        }

        // Check if the password is correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'Invalid credentials!'], 401);
        }

        // Generate the authentication token
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Success response with the token
        return response()->json([
            'status' => true,
            'message' => 'Login successful!',
            'token' => $token,  // Return the token to the client
        ]);
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
