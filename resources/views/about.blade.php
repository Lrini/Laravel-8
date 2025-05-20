@extends('layouts.main')

@section('container')
    <div class="text-center mt-5">
        <h1 class="display-4">Halaman About</h1>
        <h3>{{ $name }}</h3>
        <p>{{ $email }}</p>
        <img src="img/{{ $image }}" width="200" class="img-thumbnail rounded-circle mx-auto d-block">
    </div>
@endsection
