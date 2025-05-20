@extends('layouts.main')

@section('container')
    <h1 class="text-danger">Database Connection Error</h1>
    {{-- message berguna untuk menampilkan pesan error --}}
    <p>{{ $message }}</p>
    <p>Please check your database server and connection settings.</p>
@endsection
