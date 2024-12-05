<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Fungsi login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari admin berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        }

        // Buat token JWT
        $token = JWTAuth::fromUser($admin);

        return $this->respondWithToken($token);
    }

    // Fungsi untuk register (opsional)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'id_adminpmnt' => 'required|exists:admin_permits,id_adminpmnt',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'id_adminpmnt' => $validated['id_adminpmnt'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash password
        ]);

        return response()->json(['message' => 'Admin registered successfully!', 'admin' => $admin]);
    }

    // Fungsi logout
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to logout'], 500);
        }
    }

    // Fungsi untuk mendapatkan user yang sedang login
    public function me()
    {
        try {
            $admin = JWTAuth::parseToken()->authenticate();
            return response()->json($admin);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }
    }
    

    // Fungsi untuk merespon dengan token
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60, // Waktu token kedaluwarsa
        ]);
    }
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? response()->json(['message' => 'Password reset link sent!'], 200)
    //         : response()->json(['message' => 'Failed to send password reset link'], 400);
    // }

    // // Reset password
    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'token' => 'required',
    //         'password' => 'required|confirmed|min:8',
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'token'),
    //         function ($user) use ($request) {
    //             $user->password = Hash::make($request->password);
    //             $user->save();
    //         }
    //     );

    //     return $status === Password::PASSWORD_RESET
    //         ? response()->json(['message' => 'Password reset successfully!'], 200)
    //         : response()->json(['message' => 'Failed to reset password'], 400);
    // }
    
}
