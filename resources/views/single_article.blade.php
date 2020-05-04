@extends('layouts.app')

@section('content')
<h2 class="text-center nav-headers-links mt-5 mb-4">{{$article->title}}</h2>
<div class="row mx-auto">
    <div class="col-md-9 col-lg-6 mb-4 mb-md-0 mx-auto my-lg-auto">
        <p class="text-muted mr-5 ml-5 mt-4">{{$article->content}}</p>
    </div>
    <div class="col-md-9 col-lg-6 mb-4 mb-md-0 mx-auto">
        <div class="view overlay z-depth-1-half mt-5">
            <img src="{{$article->path}}" class="img-fluid" alt="picture">
        </div>
    </div>
</div>
@endsection
