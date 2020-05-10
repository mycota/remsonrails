<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ACCESS DENIED | {{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="icon" type="image/jpg" href="{{ asset('images/Rem_Icon.png') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><img style="width: 80px; height: 30px;" src="{{ asset('images/LOGO_REM.png') }}" alt="Remson"></a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif
<div class="col-md-12">
    <div class="row">
                <div class="col-md-6">
<div><ul class="breadcrumb" style="background-color:">
            <a href="{{ url('/home') }}"><img style="width: 30%;" src="http://localhost/remsonrails/public/images/access-denied.jpg"></a>
            </ul></div><br><br>
                </div>
    </div>
        <div class="col-md-6">
            <div class="content">
                <div class="title m-b-md" style="color: red;">
                    ACCESS DENIED !!!
                </div>
<h3>Sorry page not found or you don't have access to this page.<p> </p>
                    <p>From system Administrator.....</p></h3>

            </div>
        </div>
    </div>
</div>

    </body>
</html>
