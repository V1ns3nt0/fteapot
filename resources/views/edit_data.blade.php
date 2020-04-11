@extends('layouts.app')

@section('content')

<h2 class="text-center">Мой профиль</h2>
<div class="container mt-5">
    <div class="row mx-auto">
        <div class="col-lg-6 col-md-6 p-0">
            <h4 class="text-center mt-2">Персональные данные</h4>
            <form method="POST" action="/home/edit/data">
              @csrf
                <div class="row justify-content-center">
                    <div class=" col-lg-6 col-md-8  mb-4 mt-4">
                        <label for="lastName">Фамилия</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror " id="lastName" name="lastName" value="{{ Auth::user()->last_name }}" required>
                        @error('last_name')
                        <div class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 mb-4">
                        <label for="firstName">Имя</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="firstName" value="{{ Auth::user()->first_name }}" required>
                        @error('first_name')
                          <div class="invalid-feedback" role="alert">
                            {{$message}}
                          </div>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 mb-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" required>
                        @error('email')
                          <div class="invalid-feedback" role="alert">
                            {{$message}}
                          </div>
                        @enderror
                    </div>
                </div>

                    <div class="text-center">
                        <button type="submit" name="saveInfo" value="saveInfo" class="btn btn-green">Сохранить</button>
                    </div>
            </form>
    </div>
    <div class="col-lg-6 col-md-6 p-0">
        <h4 class="text-center mt-2">Сменить пароль</h4>
        <form method="POST" action="/home/edit/passwords">
          @csrf
          <div class="row justify-content-center">
              <div class="col-lg-6 col-md-8 mb-4 mt-4">
                  <label for="oldPass">Введите старый пароль</label>
                  <input type="password" class="form-control @error('oldPass') is-invalid @enderror"  name="oldPass" id="oldPass" placeholder="" required>
                  @error('oldPass')
                    <div class="invalid-feedback" role="alert">
                      {{$message}}
                    </div>
                  @enderror
              </div>
          </div>
          <div class="justify-content-center row">
              <div class="col-lg-6 col-md-8 mb-4">
                  <label for="newPass">Введите новый пароль</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="newPass" placeholder="" required>
                  @error('password')
                    <div class="invalid-feedback" role="alert">
                      {{$message}}
                    </div>
                  @enderror
              </div>
          </div>
          <div class="justify-content-center row">
              <div class="col-lg-6 col-md-8 mb-4">
                  <label for="newPassRepeat">Повторите новый пароль</label>
                  <input type="password" class="form-control" name="password_confirmation" id="newPassRepeat" placeholder="" required>
              </div>
          </div>
          <div class="text-center">
              <button type="submit" name="changePass" class="btn btn-green">Применить</button>
          </div>
        </form>
      </div>

</div>

@endsection
