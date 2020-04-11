@extends('layouts.app')

@section('content')
<div class="container flex-center" >
    <!-- <div class="col-lg-6 col-md-6 p-0">
        <img src="{{ asset('storage/img/bannerText.jpg') }}" alt="Banner pic" class="img-fluid">
    </div>
    <div class="col-lg-6 col-md-6  blue-grey lighten-5 p-0">
        <p class="text-center mt-5">&laquo;Чай освежает тело, укрепляет дух, смягчает сердце, пробуждает мысли,
            прогоняет леность&raquo; - говорил восточный философ и врач Ибн Сина.
            Действительно, в чае содержится очень много полезных для нашего организма веществ.
            После чаепития улучшаются общее состояние, настроение, вот почему при деловых
            встречах и в дипломатических кругах переговоры часто ведутся за чашкой чая.
            Чай также является главным атрибутом вечерних посиделок и приятных бесед.
            Давайте насладимся чашечкой чая вместе с нами! Приятного чаепития!</p>
    </div> -->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" >
  <!--Indicators-->
  <ol class="carousel-indicators">
    @for($i=0; $i<$news->count(); $i++)
    <li data-target="#carousel-example-2" data-slide-to="{{ $i }}" class="@if($i == 0) active @endif"></li>
    @endfor
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    @for($i=0; $i<$news->count(); $i++)
    <div class="carousel-item @if($i == 0) active @endif">
      <div class="view">
        <img class="d-block w-100" src="{{ $news[$i]->path }}" style="max-height:520px;"
          alt="First slide">
        <div class="mask rgba-black-light"></div>
      </div>
    </div>
    @endfor
  </div>

  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
</div>
<section class="text-center mb-4">
    <h2 class="text-center headFont">Новинки</h2>
    <div class="row mx-auto">
      @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card" style="min-height:404px;">
                <!-- <div class="pictureTea align-self-center" style='background: url("{{$product->img_path}}") 50% 50% no-repeat; ; max-width:20em; max-height:20em;'></div> -->
                <div class="align-self-center"> <img src="{{ asset($product->path) }}" alt="tea photo" style="max-width:230px; max-height:190px;"> </div>
                <div class="card-body">
                    <h4 class="card-title"><a href="/catalog/{{$product->id}}" class="nav-link green-text">{{ $product->name }}</a></h4>
                    <p class="card-text">{{ $product->card_description }}</p>
                    <div class="flex-center mb-2">
                        <div class="mr-auto ml-3">
                            <p class="card-subtitle priceCard">{{$product->	price}} руб</p>
                            <p class="card-text m-0">100грамм</p>
                        </div>
                        @auth
                        <form class="d-flex" method="POST" action="/cart/add/{{$product->id}}">
                          @csrf
                          <button type="submit">Купить</button>
                        </form>
                        @endauth
                        @guest
                        <example-component :product="{{ json_encode($product) }}"></example-component>
                        @endguest
                        <!-- <i class="fa fa-shopping-cart fa-2x mr-3" style="cursor: pointer;"></i> -->
                        <!-- <form method="POST" action="/cart/add/{{$product->id}}">
                          @csrf
                          <button type="submit">add to cart</button>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
