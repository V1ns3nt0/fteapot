@extends('layouts.main')

@section('content')
<div class="text-center my-5">
    <a href="/admin/tea/add" class="btn green darken-1 white-text">Добавить новый чай</a>
</div>
<div class="d-flex flex-wrap justify-content-center">
@foreach ($products as $product)
<div class="card mb-3 mx-1" style="min-width:20em;">
  <div class="align-self-center"> <img src="{{$product->path}}" alt="tea photo" style="max-width:230px; max-height:190px;"> </div>
  <div class="card-body">
    <h5 class="card-title nav-headers-links">{{$product->name}}</h5>
    <a class="card-link" href="/admin/tea/edit/{{ $product->id }}">Редактировать</a>
    <a class="card-link" href="/admin/tea/hide/{{ $product->id }}">@if($product->actual == 1) Скрыть @else Вернуть @endif</a>
  </div>
</div>
@endforeach
</div>
<div class="d-flex justify-content-center">
  {{ $products->links() }}
</div>
@endsection
