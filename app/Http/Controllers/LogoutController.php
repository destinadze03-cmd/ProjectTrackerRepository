<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user

        $request->session()->invalidate(); // Clears old session
        $request->session()->regenerateToken(); // Avoids CSRF attack

        return redirect('/login')->with('message', 'You have been logged out.');
    }
}
