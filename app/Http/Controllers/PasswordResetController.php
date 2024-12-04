<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\MailNotify;
use App\Models\Admin;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Send password reset link to the provided email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ]);

        $reset_token = Str::random(60);

        // Store reset_token in the admins table
        DB::table('admins')->updateOrInsert(
            ['email' => $request->email],
            [
                'reset_token' => Hash::make($reset_token), // Use reset_token column here
                'created_at' => now(),
            ]
        );

        // Send reset email
        try {
            Mail::to($request->email)->send(new MailNotify(
                [
                'subject' => 'Reset Password',
                'body' => "Here is your password reset token: $reset_token",
            ]
        ));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send reset email.'], 500);
        }

        return response()->json(['message' => 'Password reset link sent successfully.'], 200);
    }

    /**
     * Reset the password using the reset_token.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'reset_token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Check if the reset token exists in the admins table
        $resetRecord = DB::table('admins')->where('email', $request->email)->first();

        // If no record is found or the reset_token is invalid
        if (!$resetRecord) {
            return response()->json(['message' => 'No reset token found for this email.'], 400);
        }

        if (!$resetRecord->reset_token) {
            return response()->json(['message' => 'No reset token assigned for this email.'], 400);
        }

        // Check if the reset_token matches and if it's not expired
        if (!Hash::check($request->reset_token, $resetRecord->reset_token)) {
            return response()->json(['message' => 'Invalid or expired token.'], 400);
        }

        // Check if the token is expired (e.g., 1 hour expiration)
        $expiration = 60; // minutes
        if (now()->diffInMinutes($resetRecord->created_at) > $expiration) {
            return response()->json(['message' => 'The reset token has expired.'], 400);
        }

        // Update the password
        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            $admin->password = Hash::make($request->password);
            $admin->save();
        } else {
            return response()->json(['message' => 'Admin not found.'], 400);
        }

        // Delete the reset token record
        DB::table('admins')->where('email', $request->email)->update(['reset_token' => null]);

        return response()->json(['message' => 'Password reset successfully.'], 200);
    }
}
