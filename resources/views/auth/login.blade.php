@extends('layouts.auth.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <a href="{{route('guest.index')}}" class="text-decoration-none"><h1 class="text-center mb-3">{{env('APP_NAME','Laravel')}}</h1></a>
            <div class="card">

                <div class="card-header text-center">{{ __('auth.login') }}</div>

                <div class="card-body py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col">
                                <input id="username" type="text" class="form-control @error('email') is-invalid @enderror" name="username" placeholder="{{ __('auth.username') }}" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('auth.password') }}" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" >
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('auth.login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col">
                                <a href="{{route('google.redirect')}}">
                                    <img class="btn-block" src="{{asset('img/btn_google_sso.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        @if (Route::has('guest.index'))
                            <a class="btn btn-link btn-block text-decoration-none text-white" href="{{ route('guest.index') }}">
                                <i class="fas fa-arrow-left mr-3"></i>{{ __('app.return_to_home') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
