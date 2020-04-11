@extends('layouts.app')

@section('content')
<div class="filterTea text-center mt-4">
  <form method="POST" id="filtersform" action="/catalog">
    @csrf
    <div class="btn-group" role="group">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="kindTea" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Вид чая
            </button>
            <div class="dropdown-menu" aria-labelledby="kindTea">
              @foreach($kinds as $kind)
                <div class="form-check dropdown-item pl-5">
                    <input type="checkbox" class="form-check-input" name="tea_kind[]" value="{{ $kind->id }}" id="{{ $kind->id }}">
                    <label class="form-check-label" for="{{ $kind->id }}">{{ $kind->name }}</label>
                </div>
              @endforeach
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="tasteTea" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Вкус чая
            </button>
            <div class="dropdown-menu" aria-labelledby="tasteTea">
              @foreach($tastes as $taste)
                <div class="form-check dropdown-item pl-5">
                    <input type="checkbox" class="form-check-input" name="tea_taste[]" value="{{ $taste->id }}" id="{{ $taste->id }}">
                    <label class="form-check-label" for="{{ $taste->id }}">{{ $taste->name }}</label>
                </div>
              @endforeach
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="priceTea" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Стоимость
            </button>
            <div class="dropdown-menu" aria-labelledby="priceTea">
                <div class="slidecontainer pl-3">
                    <input type="range" min="150" max="1000" value="500" name="minPrice" class="slider" id="myRange">
                    <p>Цена: <span id="demo"></span></p>
                </div>
            </div>
        </div>
        <button type="submit" name="filtersbtn" id="filtersbtn"class="btn btn-green">Применить</button>
    </div>
  </form>
</div>
<div class="row mx-auto">
  @foreach ($products as $product)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card" style="min-height:404px;">
            <!-- <div class="pictureTea align-self-center" style='background: url("{{$product->img_path}}") 50% 50% no-repeat; ; max-width:20em; max-height:20em;'></div> -->
            <div class="align-self-center"> <img src="{{$product->path}}" alt="tea photo" style="max-width:230px; max-height:190px;"> </div>
            <div class="card-body">
                <h4 class="card-title"><a href="/catalog/{{$product->id}}" class="nav-link green-text">{{ $product->name }}</a></h4>
                <p class="card-text">{{ $product->card_description }}
                  <div class="flex-center mb-2">
                    <div class="mr-auto ml-3">
                        <p class="card-subtitle priceCard">{{$product->	price}} руб</p>
                        <p class="card-text">100грамм</p>
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
                    <!-- <button type="button"
                    :path="{{ json_encode($product->path) }}" :name="{{ $product->name }}"
                    :price='"{{ $product->price }}"'
                     v-on:click="addToCart({{$product->id}})">add to cart</button> -->
                    <!-- @{{quote}} -->
                      <!-- <i class="fa fa-shopping-cart fa-2x mr-3" style="cursor: pointer;"></i> -->

                  </div>
                </p>

            </div>
        </div>
    </div>
    @endforeach
    <!-- <div id="result"></div> -->
</div>
<div class="d-flex justify-content-center">
  {{ $products->links() }}
</div>


@endsection

<!-- <script type="text/javascript">
$(document).ready(function() {

      // Pass csrf token in ajax header
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // Trigger ajax function on save button click
      $("#filtersbtn").click(function() {
          var formData = $("#filtersform").serialize();
          $.ajax({
                  type    :   "POST",
                  url     :   "filteting",
                  data    :   formData,
                  dataType :   "json",

                  success: function(res) {
                      if(res.status == "success") {
                          $("#result").html("<div class='alert alert-success'>" + res.message + "</div>");
                      }

                      else if(res.status == "failed") {
                          $("#result").html("<div class='alert alert-danger'>" + res.message + "</div>");
                      }
                  }
          });
      });
  });
</script> -->
