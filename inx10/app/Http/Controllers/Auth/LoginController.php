<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLogin;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('user_ID', 'password');

        // Find the user by user_ID
        $user = UserLogin::where('user_ID', $credentials['user_ID'])->first();

        // Check if the user exists and the password matches
        if ($user && $user->user_password === $credentials['password']) {
            // Log in the user
            Auth::login($user);

            // Redirect based on user_type
            switch ($user->user_type) {
                case 1:
                    return redirect()->route('admin');
                case 2:
                    return redirect()->route('employee');
                case 3:
                    return redirect()->route('department');
                default:
                    return redirect()->route('login')->withErrors('Invalid user type.');
            }
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors('Invalid credentials.');
    }

   
}
