@extends('layouts.app')

@section('title')
    Calculadolar | Login
@endsection

@section('content')
<div class="container off">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div id="login" class="card">
                <div class="card-header px-3 py-0">
                    <!-- <div class="row bg-gray p-4">
                        <div class="col-md-auto pr-0">
                            <img class="img-fluid login_logo" src="{{asset('img/iconoDolar-sm.jpg')}}" alt="">
                        </div>
                        <div class="col-md-9 pl-0">
                            <h1 class="mb-0">CalculaDolar</h1>
                            <span>La solución para tu pequeño negocio</span>
                        </div>
                    </div> -->
                    <img class="img-fluid login_logo" src="{{asset('img/iconoDolar.jpg')}}" alt="">
                </div>
                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ __('Usuario') }}</label>
                            
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                                <input id="text" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="email" autofocus>
                            </div>
    
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Contraseña') }}</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Recuérdame') }}</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn button-green col-md-6">
                                {{ __('Iniciar sesión') }}
                            </button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Olvidé mi contraseña') }}
                            </a>
                            @endif
                        </div>
                        <hr class="mt-4">
                        <div class="form-group text-center">
                            <span>¿Todavía no tienes una cuenta? </span><a href="{{ route('register') }}">Regístrate</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection