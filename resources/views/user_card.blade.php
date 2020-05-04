@extends('layouts.app')

@section('content')
<h2 class="text-center nav-headers-links mt-5">Мой профиль</h2>
<div class="container mt-5">
    <div class="row mx-auto">
        <div class="col-lg-6 col-md-6 p-0 mx-auto">
            <h4 class="text-center nav-headers-links mt-2">Скидочная карточка</h4>
            <p class="text-center">Введите номер вашей скидочной карты, чтобы привязать к аккаунту.</p>
            <form method="POST" action="/home/userCard/safe">
              @csrf
                <div class="row justify-content-center">
                    <div class=" col-lg-6 col-md-9 mb-4 mt-4">
          
                        <input type="text" class="form-control @error('cardNum') is-invalid @enderror " placeholder="Номер карты" id="cardNum" name="cardNum" value="" required>
                        @error('cardNum')
                        <div class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>


                    <div class="text-center">
                        <button type="submit" name="saveInfo" value="saveInfo" class="btn btn-green">Привязать</button>
                    </div>
            </form>
    </div>
  </div>
</div>
@endsection
