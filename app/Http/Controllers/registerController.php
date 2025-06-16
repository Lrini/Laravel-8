<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registerController extends Controller
{
    public function index(){
        return view('register.index',[
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
       $request->validate([
        'name' => 'required|max:30',
        'username' => 'required|max:30|min:3|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:5|max:255',
    ]);
    }
}