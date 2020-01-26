<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
      .thback{ backround-color: #D3D3D3;}
    </style>

    <script type="text/javascript">
      function Clickheretoprint()
      { 
        var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
            disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
        var content_vlue = document.getElementById("content").innerHTML; 
        
        var docprint=window.open("","",disp_setting); 
         docprint.document.open(); 
         docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
         docprint.document.write(content_vlue); 
         docprint.document.close(); 
         docprint.focus(); 
      }
    </script>
</head>
<body>
<nav style="background-color: #008b9e;" class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="http://remsonrails.com/">{{ __('Remson Rail System INC') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
        
    </ul>
    <form class="form-inline my-2 my-lg-0" action="{{ route('login') }}">
    <!-- <a class="nav-link" href="{{ route('login') }}"></a> -->
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">{{ __('Login') }}</button>
    </form>
  </div>
</nav>

<main class="py-4 container">
            @include('partials.alert')
            @yield('content')
        </main>
    </div>
</body>
<footer class="my-5 pt-5 text-muted text-center text-small" style="height: 20px;">
     <ul class="list-inline">
      <li class="list-inline-item"><a href="http://remsonrails.com/">Quotation System (Remson Rail System INC)</a></li>
      <li class="list-inline-item"><a href="#"></a></li>
      <li class="list-inline-item"><a href="http://remsonrails.com/">@Remson Rail System INC</a></li>
    </ul>
  </footer>
</html>