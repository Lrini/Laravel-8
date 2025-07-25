@extends('dashboard.layout.main')
@section('container')
<div class="container">
    <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <div class="card-text">
                    {!! $post->body !!}
                </div>
                <a href="/dashboard/posts" class="btn btn-success mt-3"><span data-feather="arrow-left"></span> Back to posts</a>
                <a href="/blog" class="btn btn-warning mt-3"><span data-feather="edit"></span >Edit</a>
                <a href="/blog" class="btn btn-danger mt-3"><span data-feather="x-circle"></span> Delete</a>
            </div>
        </div>
</div>
@endsection