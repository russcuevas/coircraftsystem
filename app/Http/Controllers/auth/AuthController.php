<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function AdminLoginPage()
    {
        return view('auth.admin_login');
    }

    public function LoginPage()
    {
        return view('auth.login');
    }

    public function LoginRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
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

    public function RegisterPage()
    {
        return view('auth.register');
    }
}
