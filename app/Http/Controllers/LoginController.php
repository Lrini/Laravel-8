<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){ // jika autentikasi berhasil, auth::attempt akan mengembalikan true, fungsi auth adalah untuk mengecek apakah user sudah login atau belum
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // redirect ke halaman yang diminta sebelumnya, intended akan mengarahkan ke halaman yang diminta sebelum login, 
            //jika tidak ada halaman yang diminta sebelumnya, maka akan diarahkan ke halaman home
        }

        return back()->with('loginError','Login failed!'); // jika gagal login, kembali ke halaman login dengan pesan error
    }

}
