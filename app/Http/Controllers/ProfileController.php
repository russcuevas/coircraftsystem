<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $user->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }
}