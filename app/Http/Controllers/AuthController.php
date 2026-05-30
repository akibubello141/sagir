<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role == 'cashier') {
                return redirect('/cashier/dashboard');
            }

            if ($user->role == 'supervisor') {
                return redirect('/supervisor/dashboard');
            }

            if ($user->role == 'manager') {
                return redirect('/manager/dash');
            }
        }

        return back()->with('error', 'Invalid Login Details');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}