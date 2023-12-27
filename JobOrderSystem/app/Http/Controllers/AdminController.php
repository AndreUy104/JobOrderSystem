<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(){

        return view('admin',[
            'users' => User::paginate(10),
        ]);
    }

    public function toggleAdminAccess(Request $request, $userId)
    {
        $user = User::find($userId);

        if ($user) {
            // Toggle the 'is_admin' field
            $user->is_admin = !$user->is_admin;
            $user->save();

            return redirect()->route('admin')->with('success', 'User updated successfully!');
        }

        return redirect()->route('admin')->with('error', 'User not found or error occurred!');

    }

}
