@extends('layouts.main')

@section('content')
<form class="p-5 col-lg-6 mx-auto" method="POST" action="/admin/articles/edit/{{ $article->id }}" enctype="multipart/form-data">
    @csrf
    <p class="h2 mb-4 text-center nav-headers-links">Добавить статью</p>

    <input class="form-control mb-2 @error('title') is-invalid @enderror" id="title" value="{{ $article->title }}" name="title" type="text" placeholder="Название">
    @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <textarea class="form-control mb-2 @error('description') is-invalid @enderror" id="description" value="" name="description" placeholder="Карточное описание">{{ $article->description }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <textarea class="form-control mb-2 @error('content') is-invalid @enderror" id="content" value="" name="content" placeholder="Полное описание">{{ $article->content }}</textarea>
    @error('content')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('articleImg') is-invalid @enderror" value="{{ old('articleImg') }}" name="articleImg" id="articleImg" aria-describedby="articleImg">
            <label class="custom-file-label" for="articleImg">Фото статьи</label>
        </div>
        @error('articleImg')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button class="btn btn-green btn-block" type="submit">Сохранить</button>
</form>
@endsection
