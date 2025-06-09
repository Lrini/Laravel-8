<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { //untuk halaman awal
    return view('home',[
        "title" => "home"
    ]);
});

Route::get('/about', function () { //untuk halaman about
    return view('about',[
        "title" => "about",
        "name" => "Immanuel rini",
        "email" => "imaanuel@gmail.com",
        "image" => "iwan.jpg" 
    ]);
});

Route::get('/blog',[PostController::class,'index']); // untuk halaman blog

Route::get('posts/{post:slug}',[PostController::class,'show']); //untuk halaman post individu

Route::get('/categories', function () { //untuk halaman categories
    return view('categories',[
        'title' =>  'Post Categories',
        'categories' => Category::all(), // ambil data dari model category
    ]);
});



Route::get('/categories/{category:slug}', function (Category $category) { //untuk halaman categories individu
    return view('category',[
        'title' => "Post by category: $category->name",
        'category' => $category->load('posts.author'), // load relationship
    ]);
});

Route::get('/authors/{author:username}', function (User $author) { // untuk halaman author individu
    return view('posts_fixed' ,[ // post_fixed adalah view yang kita buat
        'title' =>  "Post by author: $author->name",
        'posts' => $author->posts->load('category','author'), // load relationship dari post ke category dan author
    ]);
});


Route::get('/login',[LoginController::class,'index']);