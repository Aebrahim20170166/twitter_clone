<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        //validate user data
        $validated = request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);
        //create new user in DB
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        //return redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'User Created Successfully');

    }
}
