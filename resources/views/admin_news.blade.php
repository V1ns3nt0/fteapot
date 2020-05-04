@extends('layouts.main')

@section('content')
<div class="text-center my-5">
    <a href="/admin/news/add" class="btn  green darken-1 white-text">Добавить новость</a>
</div>
<div class="d-flex flex-wrap justify-content-center">
@foreach ($news as $new)
<div class="card mb-3 mx-1" style="min-width:20em; max-width:20em;">
  <div class="align-self-center"> <img src="{{$new->path}}" alt="article photo" style="max-width:230px; max-height:190px;"> </div>
  <div class="card-body">
    <a class="card-link" href="/admin/news/hide/{{ $new->id }}">@if($new->actual == 1) Скрыть @else Вернуть @endif</a>
  </div>
</div>
@endforeach
</div>
<div class="d-flex justify-content-center">
  {{ $news->links() }}
</div>
@endsection
