@extends('layouts.app')

@section('content')
<h2 class="text-center">{{ __('Регистрация') }}</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col mb-4">
                                    <input type="text" id="last_name" name="last_name"
                                      class="form-control @error('last_name') is-invalid @enderror" placeholder="Фамилия"
                                      value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                      @error('last_name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                            </div>
                            <div class="col mb-4">
                              <input type="text" id="first_name" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror" placeholder="Имя"
                                value="{{ old('first_name') }}" required autocomplete="first_name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col mb-8">
                              <input type="email" id="email" name="email" class="form-control mb-4 @error('email') is-invalid @enderror"
                                placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col mb-4">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password" placeholder="Пароль">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <div class="col mb-4">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password" placeholder="Повторите пароль">
                             </div>
                        </div>
                        <button class="btn btn-green btn-block my-4 waves-effect z-depth-0" type="submit">{{ __('Зарегистрироваться') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
