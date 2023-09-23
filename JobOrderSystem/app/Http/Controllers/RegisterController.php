<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(){

        $data = request()->validate([
            'name' => 'required' ,
            'password' => 'required'
        ]);
        
        User::create($data);

        return redirect('/login')->with('success' , 'You have successfully created an account!');
    }
}
