<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
     // USERS PAGE
    public function users()
    {
        $users = User::latest()->get();

        return view(
            'manager.users',
            compact('users')
        );
    }

    // CREATE USER
    public function saveUser(Request $request)
    {
      
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

       

        return back()->with(
            'success',
            'User created successfully'
        );
    }

    // EDIT USER
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view(
            'manager.edit_user',
            compact('user')
        );
    }

    // UPDATE USER
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

       $users = User::latest()->get();

        return view(
            'manager.users',
            compact('users')
        );
    }

    //delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();    
        return back()->with(
            'success',
            'User deleted successfully'
        );
    }
}
