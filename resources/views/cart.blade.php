@extends('layouts.app')

@section('content')

@if($items !== null && count($items) > 0)
 <section class="dark-grey-text">
    <div class="">
        <div class="">
            <div class="row mx-auto">
                <div class="col-lg-8">
                    <div class="table-responsive ">
                        <table class="table product-table border border-light mb-0">
                            <tbody>
                              @auth
                              @for ($i = 0; $i < $items->count(); $i++)
                            <tr class="">
                                <th scope="row">
                                    <img src="{{$products[$i]->path}}" alt="lunczin" class="img-fluid z-depth-0">
                                </th>
                                <td class="align-middle">
                                    <h5 class="mt-3">
                                        <strong>{{$products[$i]->name}}</strong>
                                    </h5>
                                </td>
                                <td></td>
                                <td class="align-middle">{{$products[$i]->price}}&#x20bd;</td>
                                <td class="align-middle">
                                  <div class="d-flex">
                                    <form class="px-2" method="POST" action="/cart/{{$items[$i]->id}}/dec">
                                      @csrf
                                      <button type="submit">-</button>
                                    </form>
                                    {{$items[$i]->quantity}}
                                    <form class="px-2" method="POST" action="/cart/{{$items[$i]->id}}/inc">
                                      @csrf
                                      <button type="submit">+</button>
                                    </form>
                                  </div>
                                </td>
                                <td class="font-weight-bold align-middle">
                                    <strong>{{$items[$i]->price}}&#x20bd;</strong>
                                </td>
                                <td class="align-middle">
                                  <form class="px-2" method="POST" action="/cart/del/{{$items[$i]->id}}">
                                    @csrf
                                    <button type="submit" class="btn-light-green btn btn-sm greenlight-BG"
                                        data-toggle="tooltip" data-placement="top" title="Remove item">X
                                    </button>
                                  </form>

                                </td>
                            </tr>
                            @endfor
                            @endauth
                            @guest
                            <tr is ="cart-item" v-for="(product, index) in cart" :index="index" v-bind:key="product.id" :product="product" ></tr>
                            @endguest
                            </tbody>
                        </table>
                    </div>
                    <form id="makeOrder" method="POST" action="/cart/order">
                      @csrf
                      <div class="container" style="margin-top: 80px">
                          <h4>Доставка</h4>
                          <div class="row">
                              <div class="col-lg-4 col-md-6 mb-4">
                                  <label for="state">Область</label>
                                  <select name="state" class="custom-select d-block w-100 @error('state') is-invalid @enderror"  id="state" required>
                                      <option value="">Выберите...</option>
                                      <option>Шибуя</option>
                                      <option>Нагоя</option>
                                      <option>Осака</option>
                                      <option>Томская область</option>
                                      <option>Свердловская область</option>
                                  </select>
                                  @error('state')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, выберите область.</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4 col-md-6 mb-4">
                                  <label for="city">Город</label>
                                  <select name="city" class="custom-select d-block w-100 @error('city') is-invalid @enderror" id="city" required>
                                      <option value="">Выберите...</option>
                                      <option>Токио</option>
                                      <option>Киото</option>
                                      <option>Шанхай</option>
                                      <option>Томск</option>
                                      <option>Екатеринбург</option>
                                      <option>Братск</option>
                                      <option>Санкт-Питербург</option>
                                      <option>Минск</option>
                                      <option>Киев</option>
                                  </select>
                                  @error('city')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, выберите город.</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4 col-md-6 mb-4">
                                  <label for="street">Улица</label>
                                  <input name="street" type="text" class="form-control @error('street') is-invalid @enderror" id="street" value="{{ old('street') }}" autocomplete="street" required>
                                  @error('street')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, укажите улицу.</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="row">

                              <div class="col-md-2 mb-3">
                                  <label for="house">Дом</label>
                                  <input name="house" type="text" class="form-control @error('house') is-invalid @enderror" id="house" value="{{ old('house') }}" autocomplete="house" required>
                                  @error('house')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, укажите номер дома.</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-md-2 mb-3">
                                  <label for="flat">Квартира</label>
                                  <input name="flat" type="text" class="form-control" id="flat" value="{{ old('flat') }}" autocomplete="flat" required>
                              </div>
                              <div class="col-md-3 mb-3">
                                  <label for="postal_code">Индекс</label>
                                  <input name="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" value="{{ old('postal_code') }}" autocomplete="postal_code" required>
                                  @error('postal_code')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, укажите почтовый индекс.</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                      <div class="container" style="margin-top: 50px">
                          <h4>Контактная информация</h4>
                          <div class="row">
                              <div class="col-lg-4 col-md-6 mb-4">
                                  <label for="last_name">Фамилия</label>
                                  <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="@auth {{ Auth::user()->last_name }} @endauth @guest {{ old('last_name') }} @endguest" required>
                                  @error('last_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, укажите Вашу фамилию.</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4 col-md-6 mb-4">
                                  <label for="first_name">Имя</label>
                                  <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="@auth {{ Auth::user()->first_name }} @endauth @guest {{ old('first_name') }} @endguest" required>
                                  @error('first_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, укажите Ваше имя.</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4 col-md-6 mb-4">
                                  <label for="email">E-mail</label>
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="@auth {{ Auth::user()->email }} @endauth @guest {{ old('email') }} @endguest" required>
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                          <strong>Пожалуйста, укажите адрес Вашей электронной почты.</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                      <div class="container" style="margin-top: 50px">
                          <hr class="mb-4">
                          <div class="text-right">
                              <button type="submit" class="btn btn-lg btn-green" v-on:click="itemsToCookie">Оформить заказ</button>
                          </div>
                      </div>
                    </form>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card z-depth-0 border border-light rounded-0">
                        <div class="card-body">
                          @auth
                            <h4 class="mb-4 mt-1 h5 text-center font-weight-bold">Ваш заказ</h4>
                            @for ($i = 0; $i < $items->count(); $i++)
                            <dl class="row">
                                <dd class="col-sm-8">
                                   {{$products[$i]->name}}
                                </dd>
                                <dd class="col-sm-4">
                                    {{$items[$i]->price}}&#x20bd;
                                </dd>
                            </dl>
                            @endfor
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-8">
                                    Итого:
                                </dt>
                                <dt class="col-sm-4">

                                    {{$generalPr}}&#x20bd;
                                </dt>
                            </dl>
                            @endauth
                            @guest
                            <h4 class="mb-4 mt-1 h5 text-center font-weight-bold">Ваш заказ</h4>
                            <dl class="row" v-for="(item, index) in cart" :key="index">
                                <dd class="col-sm-8">
                                   @{{item.name}}
                                </dd>
                                <dd class="col-sm-4">
                                    @{{item.itemsPrice}}&#x20bd;
                                </dd>
                            </dl>
                            <hr>
                            <dl class="row">
                                <dt class="col-sm-8">
                                    Итого:
                                </dt>
                                <dt class="col-sm-4">

                                    @{{price}}&#x20bd;
                                </dt>
                            </dl>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@else

<h2>Корзина пуста</h2>
@endif
@endsection
