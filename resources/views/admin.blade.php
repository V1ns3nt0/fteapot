@extends('layouts.main')

@section('content')
<h2 class="text-center nav-headers-links mt-5">Админ панель</h2>
<div class="container-fluid mt-5">
  <section class="">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6 col-lg-2 mb-4">
        <div class="card primary-color white-text">
          <div class="card-body d-flex text-center">
            <div class="text-center">
              <!-- <p class="h2-responsive font-weight-bold mt-n2 mb-0">150</p> -->
              <a href="/admin/tea" class="mb-0 nav-headers-links white-text fnts-16 text-center">Чай</a>
            </div>
            <!-- <div>
              <i class="fas fa-shopping-bag fa-4x text-black-40"></i>
            </div> -->
          </div>
          <a href="/admin/tea" class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-2 mb-4">
        <div class="card warning-color white-text">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <!-- <p class="h2-responsive font-weight-bold mt-n2 mb-0">53 %</p> -->
              <a href="/admin/articles" class="mb-0 white-text nav-headers-links fnts-16">Статьи</a>
            </div>
            <!-- <div>
              <i class="fas fa-chart-bar fa-4x text-black-40"></i>
            </div> -->
          </div>
          <a href="/admin/articles" class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-2 mb-4">
        <div class="card light-blue lighten-1 white-text">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <!-- <p class="h2-responsive font-weight-bold mt-n2 mb-0">44</p> -->
              <a href="/admin/news" class="mb-0 white-text nav-headers-links fnts-16">Новости</a>
            </div>
            <!-- <div>
              <i class="fas fa-user-plus fa-4x text-black-40"></i>
            </div> -->
          </div>
          <a href="/admin/news" class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-2 mb-4">
        <div class="card red accent-2 white-text">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <!-- <p class="h2-responsive font-weight-bold mt-n2 mb-0">65</p> -->
              <a href="/admin/staff" class="mb-0 white-text nav-headers-links fnts-16">Сотрудники</a>
            </div>
            <!-- <div>
              <i class="fas fa-chart-pie fa-4x text-black-40"></i>
            </div> -->
          </div>
          <a href="/admin/staff" class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-2 mb-4">
        <div class="card  cyan darken-2 white-text">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <!-- <p class="h2-responsive font-weight-bold mt-n2 mb-0">65</p> -->
              <a href="/admin/orders" class="mb-0 white-text nav-headers-links fnts-16">Заказы</a>
            </div>
            <!-- <div>
              <i class="fas fa-chart-pie fa-4x text-black-40"></i>
            </div> -->
          </div>
          <a href="/admin/orders" class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
  <a href="/admin/tea" class="btn btn-success">Чай</a>
  <a href="/admin/articles" class="btn btn-amber">Статьи</a>
  <a href="/admin/news" class="btn btn-red">Новости</a>
  <a href="/admin/staff" class="btn btn-primary">Сотрудники</a>
</div> -->

<div class="container my-5">
  <section>
    <h2 class="text-center nav-headers-links mb-4">Последние заказы</h2>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID Заказа</th>
                  <th scope="col">Товары</th>
                  <th scope="col">Заказчик</th>
                  <th scope="col">Адрес доставки</th>
                  <th scope="col">Стоимость</th>
                  <th scope="col">Статус</th>
                </tr>
              </thead>
              <tbody>
                @for ($i = 0; $i < $orders->count(); $i++)
                <tr>
                  <th scope="row">{{$orders[$i]->id}}</th>
                  <td>
                    <ul>
                      @foreach($items[$i] as $item)
                        <li>{{$item}}</li>
                      @endforeach
                    </ul>
                  </td>
                  <td>{{$orders[$i]->last_name}} {{$orders[$i]->first_name}} <br>
                    <span class="font-italic">{{$orders[$i]->email}}</span>
                  </td>
                  <td>{{$orders[$i]->state}} {{$orders[$i]->city}} <br>
                    {{$orders[$i]->street}} {{$orders[$i]->house}}, кв. {{$orders[$i]->flat}}<br>
                    <span class="font-italic">{{$orders[$i]->postal_code}}</span>
                  </td>
                  <td>{{$orders[$i]->price}} руб</td>
                  <td>@if($orders[$i]->status == 2) В процессе @else Завершен @endif</td>
                </tr>
                @endfor
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>
@endsection
