<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();

        return redirect('/login')->with('success' , 'Goodbyeeee');
    }

    public function login(){
        return view('login');
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($data)){
            return redirect('/')->with('success' , 'Welcome back');
        }

        return back()
            ->withInput()
            ->withErrors(['email' => 'Name or Password does not Exists']);

    }
}
