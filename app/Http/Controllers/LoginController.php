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

    public function logout(){
        Auth::logout(); // untuk logout user, fungsi ini akan menghapus session user yang sedang login
        // Setelah logout, kita perlu menghapus session dan token CSRF untuk keamanan
        // Ini akan memastikan bahwa sesi pengguna tidak dapat digunakan lagi setelah logout.
        // Kita juga akan mengarahkan pengguna kembali ke halaman login.
        request()->session()->invalidate();//
        request()->session()->regenerateToken();// untuk menghindari serangan CSRF (Cross-Site Request Forgery)
        return redirect('/login');// mengarahkan ke halaman login setelah logout
    }

}
