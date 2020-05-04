@extends('layouts.main')

@section('content')
<div class="text-center my-5">
    <a href="/admin/articles/add" class="btn green darken-1 white-text">Добавить статью</a>
</div>
<div class="d-flex flex-wrap justify-content-center">
@foreach ($articles as $article)
<div class="card mb-3 mx-1" style="min-width:20em; max-width:20em;">
  <div class="align-self-center"> <img src="{{$article->path}}" alt="article photo" style="max-width:230px; max-height:190px;"> </div>
  <div class="card-body">
    <h5 class="card-title nav-headers-links">{{$article->title}}</h5>
    <a class="card-link" href="/admin/articles/edit/{{ $article->id }}">Редактировать</a>
    <a class="card-link" href="/admin/articles/del/{{ $article->id }}">Удалить</a>
  </div>
</div>
@endforeach
</div>
<div class="d-flex justify-content-center">
  {{ $articles->links() }}
</div>
@endsection
