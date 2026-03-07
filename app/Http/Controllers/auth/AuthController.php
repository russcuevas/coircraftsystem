<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function AdminLoginPage()
    {
        return view('auth.admin_login');
    }

    public function LoginPage()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function RegisterPage()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }


    public function LoginRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        // Check if email is verified
        if (!$user->is_email_verified) {
            return back()->with('error', 'Please verify your email before logging in.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Incorrect password');
        }

        Auth::loginUsingId($user->id);

        return redirect('/')->with('success', 'Login successful');
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful');
    }


    public function RegisterRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required',
            'address' => 'required',
        ]);

        try {
            $user = \App\Models\User::create([
                'fullname' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'password' => bcrypt($request->password),
                'verification_code' => Str::random(32),
                'is_email_verified' => 0,
            ]);

            Mail::to($user->email)->send(new VerifyEmail($user));

            return redirect()->back()->with('success', 'Account created! Please verify your email.');

        } catch (\Exception $e) {
            // Catch validation, DB, or mail errors
            return redirect()->back()->with('error', 'Registration failed: '.$e->getMessage());
        }
    }

    public function VerifyEmail($code)
    {
        $user = \App\Models\User::where('verification_code', $code)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Invalid verification link.');
        }

        if ($user->is_email_verified) {
            return redirect('/login')->with('success', 'Email already verified.');
        }

        $user->is_email_verified = 1;
        $user->verification_code = null; // optional: remove the code after verification
        $user->save();

        return redirect('/login')->with('success', 'Email verified successfully! You can now log in.');
    }
}
