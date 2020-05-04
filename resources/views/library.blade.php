@extends('layouts.app')

@section('content')
<h2 class="text-center nav-headers-links mt-5 ">Библиотека</h2>
<div class="row mx-auto mg-70">
  @foreach ($articles as $article)
  <div class="col-lg-3 col-md-6 mb-4">
  <div class="card" style="min-height:453px;">
    <div class="view overlay">
      <img class="card-img-top"
        src="{{ $article->path }}" alt="Card image cap">
      <a>
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <div class="card-body">
      <a href="/library/{{$article->id}}" class="green-text text-center nav-headers-links fnts-24"><h4 class="card-title">{{$article->title}}</h4></a>
      <hr>
      <p class="card-text font-italic text-center">{{$article->description}}</p>
      <a href="/library/{{$article->id}}" class="black-text d-flex justify-content-end">
        <h5>Read more <i class="fas fa-angle-double-right"></i></h5>
      </a>
    </div>
  </div>
</div>
  @endforeach
</div>
<div class="d-flex justify-content-center mt-3">
{{ $articles->links() }}
</div>
@endsection
