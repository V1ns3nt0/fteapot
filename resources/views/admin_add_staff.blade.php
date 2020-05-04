@extends('layouts.main')

@section('content')
<form class="p-5 col-lg-6 mx-auto" method="POST" action="/admin/staff/add">
    @csrf
    <p class="h2 mb-4 text-center nav-headers-links">Добавить сотрудника</p>

    <input class="form-control mb-2 @error('lastName') is-invalid @enderror" id="lastName" value="{{ old('lastName') }}" name="lastName" type="text" placeholder="Фамилия">
    @error('lastName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input class="form-control mb-2 @error('firstName') is-invalid @enderror" id="firstName" value="{{ old('firstName') }}" name="firstName" type="text" placeholder="Имя">
    @error('firstName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input class="form-control mb-2 @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" type="email" placeholder="E-mail">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" id="newPass" placeholder="Пароль" >
    @error('password')
      <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </div>
    @enderror

    <input type="password" class="form-control mb-2" name="password_confirmation" id="newPassRepeat" placeholder="Повторите пароль">


    <button class="btn btn-green btn-block" type="submit">Добавить</button>
</form>
@endsection
