<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetSuccessMail;
use Illuminate\Support\Facades\Session;

class PasswordOtpController extends Controller
{
    // Show forgot password form
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email not found.');
        }

        $otp = rand(100000, 999999);

        // Save or update OTP using Eloquent
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => now(),
            ]
        );

        // Send OTP via email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        // Store email in session
        Session::put('password_reset_email', $request->email);

        return redirect()->route('verify.otp')->with('success', 'OTP sent to your email.');
    }

    // Show OTP form
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);
        $email = Session::get('password_reset_email');

        $record = PasswordReset::where('email', $email)
            ->where('token', $request->otp)
            ->first();

        if (!$record) {
            return back()->with('error', 'Invalid OTP.');
        }

        if (now()->diffInMinutes($record->created_at) > 10) {
            return back()->with('error', 'OTP expired.');
        }

        Session::put('otp_verified', true);
        return redirect()->route('reset.password')->with('success', 'OTP verified.');
    }

    // Show reset password form
    public function showResetForm()
    {
        if (!Session::get('otp_verified')) {
            return redirect()->route('forgot.password')->with('error', 'Please verify OTP first.');
        }

        return view('auth.reset-password');
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = Session::get('password_reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $new_pass = $request->password;

        $user->update(['password' => Hash::make($request->password)]);

        // Send Welcome Email
        Mail::to($email)->send(new PasswordResetSuccessMail(
            $email,
            $new_pass,
            url('http://127.0.0.1:8000/login')
        ));

        // delete up
        PasswordReset::where('email', $email)->delete();
        Session::forget(['password_reset_email', 'otp_verified']);

        return redirect('login')->with('success', 'Password successfully reset.');
    }
}
