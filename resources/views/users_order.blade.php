@extends('layouts.app')

@section('content')

<h2 class="text-center">Мои заказы</h2>
<div class="container mt-4">
    <table class="table table-responsive">
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
            <td>{{ $orders[$i]->status }}</td>
        </tr>
          @endfor
        </tbody>
    </table>
</div>

@endsection
