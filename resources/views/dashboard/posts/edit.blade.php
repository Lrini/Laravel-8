@extends('dashboard.layout.main')
@section('container')    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/posts/{{$post->slug}}" class="mb-5">
      @method('put') <!-- gunakan method put untuk update data -->
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid  @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required autofocus  >
        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">slug</label>
        <input type="text" class="form-control @error('slug') is-invalid  @enderror" id="slug" name="slug"  value="{{ old('slug', $post->slug) }}" required >
        @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category_id">
          @foreach ($categories as $category)
           @if (old('category_id', $post->category_id) == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else 
             <option value=" {{ $category->id }}">{{ $category->name }}</option>
           @endif
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @error('body')
          <p class="text-danger">{{ $message }}</p>
        @enderror
        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body"></trix-editor>
      </div>
      <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
<!-- Script untuk mengubah slug otomatis berdasarkan judul -->
<script>
    const title = document.querySelector('#title');//definisikan elemen title untuk mengambil nilai dari input title digunakan untuk mengubah slug secara otomatis
    const slug = document.querySelector('#slug');//definisikan elemen slug untuk mengambil nilai dari input slug

    title.addEventListener('change', function() { // menambahkan event listener pada perubahan nilai title
        fetch('/dashboard/posts/checkSlug?title=' + title.value)// melakukan fetch ke endpoint checkSlug dengan mengirimkan nilai title sebagai parameter
            .then(response => response.json())// mengubah response menjadi format JSON
            .then(data => slug.value = data.slug);// mengubah nilai slug dengan nilai slug yang didapat dari response
    });
    document.addEventListener('trix-file-accept', function(e) {// mencegah file yang tidak diizinkan untuk diunggah
        e.preventDefault();// mencegah perilaku default dari trix-editor
        alert("File not allowed!");// menampilkan alert bahwa file tidak diizinkan
    });

</script>
@endsection