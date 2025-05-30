@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Category: {{ $category->name }}</h1> {{-- untuk menampilkan nama category --}}

     <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <form action="/blog" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by title..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if($category->posts->count()) {{-- untuk menampilkan post jika ada --}}
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($category->posts as $post) {{-- untuk menampilkan post --}}
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">
                                {{-- link post --}}
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a>
                            </h2>
                            <p class="card-text text-muted">
                                by 
                                @if($post->author) {{-- untuk menampilkan author --}}
                                    <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>
                                @else
                                    Unknown author
                                @endif
                            </p>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            {{-- untuk menapilkan slug pada halaman post --}}
                            <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More..</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No posts found in this category.</p>
    @endif
@endsection
