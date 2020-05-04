@extends('layouts.main')

@section('content')
<div class="container">
  <div class="col-12">
    <div class="card card-list">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">ID Заказа</th>
              <th scope="col">Товары</th>
              <th scope="col">Заказчик</th>
              <th scope="col">Адрес доставки</th>
              <th scope="col">Стоимость</th>
              <th scope="col">Статус</th>
              <th scope="col"></th>
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
              <td>@if($orders[$i]->status == 2) <form class="" action="/admin/orders/change/{{ $orders[$i]->id }}" method="POST">
                @csrf
                <button class="btn btn-sm green darken-1 white-text" type="submit" name="button">Завершить заказ</button>
              </form> @endif</td>
            </tr>
            @endfor
          </tbody>
        </table>
        {{ $orders->links() }}
      </div>

    </div>
  </div>
</div>
@endsection
