@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Post Categories:</h1>
    <ul class="list-group">
        @foreach ($categories as $category) {{-- untuk menampilkan data dari database dimana $categories adalah variabel yang diambil dari route web  --}}
            <li class="list-group-item">
                {{-- link untuk menuju halaman post dengan parameter category_id --}}
                <a href="/categories/{{ $category->slug }}" class="text-decoration-none">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
