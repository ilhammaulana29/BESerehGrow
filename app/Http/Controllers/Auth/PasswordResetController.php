<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class PasswordResetController extends Controller
{
    // Request reset token
    public function requestReset(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins,email']);

        $status = Password::broker('admins')->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Token reset password telah dikirim ke email Anda.'])
            : response()->json(['message' => 'Gagal mengirim token reset.'], 500);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Admin $admin, $password) {
                $admin->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password berhasil diubah.'])
            : response()->json(['message' => 'Token reset tidak valid atau kedaluwarsa.'], 500);
    }
}

