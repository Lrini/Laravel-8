@extends('dashboard.layout.main')
@section('container')
<div class="container">
    <div class="card mb-4">
            <div class="card-body">
                <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mb-3">
                <h2 class="card-title">{{ $post->title }}</h2>
                <div class="card-text">
                    {!! $post->body !!}
                </div>
                <a href="/dashboard/posts" class="btn btn-success mt-3"><span data-feather="arrow-left"></span> Back to posts</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mt-3"><span data-feather="edit"></span >Edit</a>
                 <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger mt-3" onclick="return confirm('Are you sure')"><span data-feather="x-circle"></span>Delete</button>
                    </form>
            </div>
        </div>
</div>
@endsection