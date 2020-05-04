@extends('layouts.app')

@section('content')
<h2 class="text-center nav-headers-links mt-5">{{ __('Войти') }}</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="">
                <div class="card-body">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                          <div class="col mb-4">
                              <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="col mb-4">
                              <input id="password" type="password" placeholder="Пароль" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      <div class="d-flex justify-content-around">
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Запомнить меня') }}
                                </label>
                            </div>
                        </div>
                          <div>
                            @if (Route::has('password.request'))
                                <a class="green-text" href="{{ route('password.request') }}">
                                    {{ __('Забыли пароль?') }}
                                </a>
                            @endif
                          </div>
                      </div>
                      <button type="submit"  class="btn btn-green btn-block my-4 waves-effect z-depth-0">
                          {{ __('Войти') }}
                      </button>
                    </form>

                  <!-- </form>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                              @if (Route::has('password.request'))
                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                      {{ __('Forgot Your Password?') }}
                                  </a>
                              @endif
                            </div>

                        </div>
                        <button type="submit"  class="btn btn-green btn-block my-4 waves-effect z-depth-0">
                            {{ __('Войти') }}
                        </button>

                    </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
