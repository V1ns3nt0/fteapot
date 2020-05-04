@extends('layouts.app')

@section('content')

<h2 class="text-center nav-headers-links mt-5">Мои заказы</h2>
@if($orders !== null && count($orders) > 0)
<div class="table-responsive container mt-4 text-center">
    <table class=" table  mx-auto w-auto ">
        <thead>
        <tr>
          <th scope="col">№ заказа</th>
          <th scope="col">Товары</th>
          <th scope="col">Стоимость</th>
          <th scope="col">Дата</th>
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
            <td>{{$orders[$i]->price}}&#x20bd;</td>
            <td>{{ $orders[$i]->created_at }}</td>
            <td>@if($orders[$i]->status == 2) В процессе @else Завершен @endif</td>
            <td>@if($orders[$i]->status == 2) <form class="" action="/home/orders/change/{{ $orders[$i]->id }}" method="POST">
              @csrf
              <button class="btn btn-sm green darken-1 white-text" type="submit" name="button">Завершить заказ</button>
            </form> @endif</td>
        </tr>
          @endfor
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
    {{ $orders->links() }}
  </div>
</div>
@else
<h2 class="text-center mt-5">Вы не сделали еще ни одного заказа</h2>
@endif
@endsection
