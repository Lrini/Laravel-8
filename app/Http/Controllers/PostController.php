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
        // mengambil data dari table post
        try { // menggunakan try-catch untuk menangani error
            // membangun query dengan relasi author dan category
            $query = Post::with(['author','category'])->latest();
            if(request()->has('search')){ // jika ada parameter search
                $query->where('title', 'like', '%' . request('search') . '%'); // mencari data berdasarkan judul
            }
            if(request()->has('category')){ // jika ada parameter category
                $query->whereHas('category', function($q){
                    $q->where('name', request('category'));
                }); // mencari data berdasarkan nama category
            }
            if(request()->has('author')){ // jika ada parameter author
                $query->whereHas('author', function($q){
                    $q->where('name', 'like', '%' . request('author') . '%');
                }); // mencari data berdasarkan nama author
            }
            $posts = $query->get();
            $categories = Category::all(); // ambil semua kategori untuk dropdown
        } catch (QueryException $e) { // jika terjadi error 
            // mengirimkan pesan error fungsi response adalah untuk mengirimkan data ke view 
            return response()->view('errors.database', ['message' => 'Database connection error: ' . $e->getMessage()], 500);
        }
        // mengirimkan data ke view posts
        return view('posts_fixed',[
            "title" => "All Posts",
            "posts" => $posts,
            "search" => request('search'),
            "category" => request('category'),
            "author" => request('author'),
            "categories" => $categories,
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
