<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function index(){
        return view('register.index',[
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
      $validateData = $request->validate([
        'name' => 'required|max:30',
        'username' => 'required|max:30|min:3|unique:users',
        'email' => 'required|email:dns|unique:users',
        'password' => 'required|min:5|max:255',
    ]);

        // enkripsi password
        //$validateData['password'] = bcrypt($validateData['password']);
        $validateData['password'] = Hash::make($validateData['password']);
        // buat user baru
        // User::create($validateData); // cara ini tidak disarankan karena tidak aman
        // lebih baik menggunakan create dengan guarded di model User
    User::create($validateData);
    //session()->flash('success', 'Registration successful! Please login');
    return redirect('/login')->with('success', 'Registration successful! Please login');
    }
}