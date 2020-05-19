<nav class="navbar navbar-expand-lg navbar-dark navhead" style="color: black; background-color: #292b33; font-size: 18px;">
    <a class="navbar-brand" href="http://www.remsonrail.com"><img style="width: 80px; height: 30px;" src="{{ $logo }}" alt="Remson"></a>

    <!-- <img style="width: 80px; height: 30px;" src={{ "../images/LOGO.png" }} alt="Nothing"> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01" style="color: black;">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.index') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('quotations.index') }}">Quotations</a>
        </li>
      </ul>

        <ul class="navbar-nav ml-auto ">
            <ul class="navbar-nav ml-auto notify-menu" style="margin-right: 10px;">
                @if(Auth::check())
                    <notification :userid="{{ auth()->user()->id }}" :unreads="{{ auth()->user()->unreadnotifications }}"></notification>
                @endif
            </ul>
      <ul class="navbar-nav ml-auto main-menu">
          <a style="color: white;" href="{{ route('profile.show', Auth::user()->id) }}"><i class="fa fa-user-circle fa-2x"></i></a><li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span></a>

          <div class="dropdown-menu dropdown-menu-right  sub-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">{{ __('Profile') }}
          </a>
          <a class="dropdown-item" data-toggle="modal" data-target="#changePassModal" href="#">
          {{ __('Change Password') }}</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          </div>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
        @csrf
      <button class="btn btn-danger disabled my-2 my-sm-0" type="submit">Logout</button>
      </form>
    </div>
  </nav>
  <br><br>
