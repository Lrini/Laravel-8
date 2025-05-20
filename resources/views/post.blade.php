@extends('layouts.main')

@section('container')
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="text-muted mb-2">
                {{-- link authors name to their profile page --}}
                by <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in 
                {{-- link category name to their category page --}}
                <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>
            </p>
            <div class="card-text">
                {!! $post->body !!}
            </div>
            <a href="/blog" class="btn btn-primary mt-3">Back to posts</a>
        </div>
    </div>
@endsection
