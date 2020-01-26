<nav class="navbar navbar-expand-lg navbar-dark " style="color: black; background-color: #292b33; font-size: 18px;">
    <a class="navbar-brand" href="http://wwww.remsonrail.com"><img style="width: 80px; height: 30px;" src={{ "../images/LOGO_REM.png" }} alt="Remson"></a>

    <!-- <img style="width: 80px; height: 30px;" src={{ "../images/LOGO.png" }} alt="Nothing"> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarColor01" style="color: black;">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a class="nav-link" id="usrs" href="{{ route('admin.users.index') }}">Users <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Quotations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Packing list</a>
        </li>

      </ul>      

      <ul class="navbar-nav ml-auto">                           
      <a style="color: white;" href="{{ route('profile.show', Auth::user()->id) }}"><i class="fa fa-user-circle fa-2x"></i></a><li class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
      {{ Auth::user()->name }} <span class="caret"></span></a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">{{ __('Profile') }}
      </a>
      <a class="dropdown-item" href="{{ route('passwords.edit', Auth::user()->id) }}">
      {{ __('Change Password') }}</a>
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      </div>
      </li>
      </div>
      <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
        @csrf
      <button class="btn btn-danger disabled my-2 my-sm-0" type="submit">Logout</button>
      </form>
            
      </ul>
    </div>
  </nav>