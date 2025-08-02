<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index',[
            'posts' => Post::where('user_id', auth()->user()->id)->get(), // ambil semua post yang dibuat oleh user yang sedang login
            'categories' => Category::all(), // ambil semua kategori
            'title' => 'My Posts'
        ])->with('success', 'Post retrieved successfully'
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create',[
            'categories' => Category::all()// munculkan semua kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi inputan dari form
        // 'title' harus diisi, maksimal 255 karakter
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'body' => 'required'
        ]);
        // Tambahkan user_id ke dalam data yang akan disimpan
        // ambil user yang sedang login dan simpan id-nya   
        // 'excerpt' diambil dari body, maksimal 200 karakter
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validatedData); // simpan data post ke database

        // Redirect ke halaman posts dengan pesan sukses
        return redirect('/dashboard/posts')->with('success', 'Post has been created successfully');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show',[
            'post' => $post,
            'title' => 'Post Details'
        ])->with('success', 'Post retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        return view('dashboard.posts.edit',[
            'post' => $post,
            'categories' => Category::all()// munculkan semua kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validasi inputan dari form
        // 'title' harus diisi, maksimal 255 karakter
        // 'slug' harus unik, kecuali jika slug tidak berubah   
         $rules =[
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'body' => 'required'
        ];
        // Jika slug tidak berubah, maka tidak perlu validasi unik
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
         $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData); // simpan data post ke database

        // Redirect ke halaman posts dengan pesan sukses
        return redirect('/dashboard/posts')->with('success', 'Post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
         Post::destroy($post->id); // simpan data post ke database
        // Redirect ke halaman posts dengan pesan sukses

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted successfully');
    }

    public function checkslug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

}
