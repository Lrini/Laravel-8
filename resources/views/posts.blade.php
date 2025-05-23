@extends('layouts.main')
@section('container')
    <h1 class="mb-5">Blog Posts</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($posts as $post)
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
@endsection
