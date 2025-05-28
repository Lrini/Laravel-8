<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
    // fungsi untuk menampilkan data post
    public function index(){
        // ambil data dari model Post
        return view('posts_fixed',[
            "title" => "All Posts",
            "posts" => Post::latest()->filter(request(['search']))->get() // ambil data dari model Post, latest() untuk mengurutkan data berdasarkan tanggal terbaru, filter() untuk mencari data berdasarkan keyword
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
