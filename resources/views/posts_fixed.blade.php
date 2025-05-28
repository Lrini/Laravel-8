@extends('layouts.main')
@section('container')
    <h1 class="mb-3 text-center">Blog Posts</h1>

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

    @if($posts->count())
        {{-- Newest post --}}
        @php
            $newest = $posts->first(); // Get the first post
            $others = $posts->slice(1); // Get all posts except the first
        @endphp

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title display-4">
                    <a href="/posts/{{ $newest->slug }}" class="text-decoration-none">{{ $newest->title }}</a>
                </h2>
                <p class="card-text text-muted">
                    by 
                    @if($newest->author)
                        <a href="/authors/{{ $newest->author->username }}" class="text-decoration-none">{{ $newest->author->name }}</a> 
                        {{--author diambil dari relasi author di model Post untuk mendapatkan nama penulis--}}
                    @else
                        Unknown author
                    @endif
                    in 
                    @if($newest->category)
                        <a href="/categories/{{ $newest->category->slug }}" class="text-decoration-none">{{ $newest->category->name }}</a>
                    @else
                        Uncategorized
                    @endif
                </p>
                <p class="card-text">{{ $newest->excerpt }}</p>
                <a href="/posts/{{ $newest->slug }}" class="btn btn-primary">Read More..</a>
            </div>
        </div>

        {{-- Other posts --}}
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($others as $post) {{-- digunakan untuk mengulang data post dari database selain post terbaru --}}
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a>
                            </h2>
                            <p class="card-text text-muted">
                                by 
                                @if($post->author)
                                    <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>
                                @else
                                    Unknown author
                                @endif
                                in 
                                @if($post->category)
                                    <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
                                @else
                                    Uncategorized
                                @endif
                            </p>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More..</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No posts found.</p>
    @endif
@endsection
