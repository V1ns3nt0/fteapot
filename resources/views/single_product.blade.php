@extends('layouts.app')

@section('content')
<h2 class="text-center">{{ $product->name }}</h2>
<div class="row mx-auto">
    <div class="col-md-12">
        <div class="text-center">
            <div class="card-body px-5 pt-5 pb-4">
                <div class="row mx-auto">
                    <div class="col-lg-4 col-md-12">
                        <div class="view overlay bg-white z-depth-1 mb-4" style="height: 360px">
                            <img src="{{ $product->path }}" class="img-fluid rounded-0" style="margin-top: 90px"
                                 alt="Sample image">
                            <a>
                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-8 text-left mb-4">
                        <p class="dark-grey-text">
                          {{ $product->full_description }}
                        </p>
                    </div>
                    <div class="col-md-4  d-flex flex-column my-lg-5 my-md-auto">
                        <div class="">
                            <p class="card-subtitle priceCard">{{ $product->price }}</p>
                            <p class="card-text m-0">100грамм</p>
                        </div>
                        @auth
                        <form method="POST" action="/cart/add/{{$product->id}}">
                          @csrf
                          <button class="btn btn-green btn-lg" type="submit">Купить</button>
                        </form>
                        @endauth
                        @guest
                        <example-component class="btn btn-green btn-lg" :product="{{ json_encode($product) }}"></example-component>
                        @endguest

                        <!-- <a class="btn btn-green btn-lg">Купить</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
