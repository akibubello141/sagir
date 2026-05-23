<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

            return $credentials;
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role == 'cashier') {
                return redirect('/dashboard/cashier');
            }

            if ($user->role == 'supervisor') {
                return redirect('/dashboard/supervisor');
            }

            if ($user->role == 'manager') {
                return redirect('/dashboard/manager');
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