<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
    // fungsi untuk menampilkan data post
    public function index(){
        // mengambil data dari table post
        try {
            $posts = Post::with(['author','category'])->latest()->get();
        } catch (QueryException $e) { // jika terjadi error 
            // mengirimkan pesan error fungsi response adalah untuk mengirimkan data ke view 
            return response()->view('errors.database', ['message' => 'Database connection error: ' . $e->getMessage()], 500);
        }
        return view('posts_fixed',[
            "title" => "All Posts",
            "posts" => $posts
        ]);
    }
    // fungsi untuk menampilkan data post berdasarkan id
    public function show (Post $post){ // parameter $post diambil dari model Post
        return view ('post',[
            "title" => "Single Post",
            "post" => $post
        ]);
    }
}
