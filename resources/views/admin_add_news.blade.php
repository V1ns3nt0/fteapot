@extends('layouts.main')

@section('content')
<form class="p-5 col-lg-6 mx-auto" method="POST" action="/admin/news/add" enctype="multipart/form-data">
    @csrf
    <p class="h2 mb-4 text-center nav-headers-links">Добавить банер</p>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('newsImg') is-invalid @enderror" name="newsImg" id="newsImg" aria-describedby="newsImg">
            <label class="custom-file-label" for="newsImg">Банер</label>
        </div>
        @error('newsImg')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button class="btn btn-green btn-block" type="submit">Добавить</button>
</form>
@endsection
