<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login-Remson Rail Systems</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="icon" type="image/jpg" href="{{ asset('images/Rem_Icon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="padding-top: 0px">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            

                <div class="card-body" style="border: 1px solid #008b9e; box-shadow: 14px 12px 8px gray;">

                
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="form-group"> <img style="" class="card-img-top" src="{{ asset('images/LOGO_REM.jpg') }}" ></div>
                    <hr style="background-color: #008b9e;">

                    @include('partials.alert')

                

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email/Username') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="active" type="hidden" class="form-control @error('active') is-invalid @enderror" name="active" value="{{ old('active') }}"  autocomplete="active" autofocus>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                                    

                                    <label class="form-check-label" for="remember">
                                        Contact system administrator for access if you don't have one
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer class="my-5 pt-5 text-muted text-center text-small" style="height: px;">
     <ul class="list-inline">
      <li class="list-inline-item"><a href="http://remsonrail.com/">Quotation System (Remson Rail Systems)</a></li>
      <li class="list-inline-item"><a href="#"></a></li>
      <li class="list-inline-item"><a href="http://remsonrail.com/">@Remson Rail Systems</a></li>
    </ul>
  </footer>

