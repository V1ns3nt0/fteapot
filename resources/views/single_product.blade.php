@extends('layouts.app')

@section('content')
<h2 class="text-center nav-headers-links mt-5 mb-4">{{ $product->name }}</h2>
<div class="row mx-auto">
    <div class="col-md-12">
        <div class="text-center">
            <div class="card-body px-5 pt-5 pb-4">
                <div class="row mx-auto">
                    <div class="col-lg-4 col-md-12">
                        <div class="view overlay bg-white z-depth-1 mb-4" >
                            <img src="{{ $product->path }}" class="img-fluid rounded-0 py-5 px-3"
                                 alt="Sample image">
                            <a>
                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-5 col-md-8 text-left mb-4">
                        <p class="dark-grey-text">
                          {{ $product->full_description }}
                        </p>
                        <hr>
                        <div class="d-flex justify-content-around">
                          <div class="">
                            <span class="font-weight-bold">Вид чая:</span> <span>{{ $kind }}</span>
                          </div>
                          <div class="">
                            <span class="font-weight-bold">Вкус чая:</span> <span>{{ $taste }}</span>
                          </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-4  d-flex flex-column my-lg-5 my-md-auto">
                        <div class="">
                            <p class="card-subtitle fnts-24">{{ $product->price }} руб</p>
                            <p class="card-text m-0">100 грамм</p>
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
