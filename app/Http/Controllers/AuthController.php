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

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        //validate user data
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        //check user data
        if(auth()->attempt($validated)) {
            //clearing the cache
            request()->session()->regenerate();
            //redirecting to dashboard
            return redirect()->route('dashboard')->with('success', 'User Logged In Successfully');
        }
        //return redirect to dashboard with errorr message
        return redirect()->route('login')->withErrors(
            [
                'email' => 'No matching user found with the provided
                email and password'
         ]
        );

    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'User Logged Out Successfully');
    }

}
