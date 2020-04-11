@extends('layouts.app')

@section('content')
<div class="row mx-auto">
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
      <h4 class="card-title">{{$article->title}}</h4>
      <hr>
      <p class="card-text">{{$article->description}}</p>
      <a href="/library/{{$article->id}}" class="black-text d-flex justify-content-end">
        <h5>Read more <i class="fas fa-angle-double-right"></i></h5>
      </a>
    </div>
  </div>
</div>
  @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $articles->links() }}
</div>
@endsection
