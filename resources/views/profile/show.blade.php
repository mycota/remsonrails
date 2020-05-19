@extends('layouts.app', ['title' => 'Profile',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')

<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                        <ul class="nav nav-pills addcolor">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('profile.show', Auth::user()->id) }}">Profile</a></button>
                          </li>

                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#changePassModal"><a class="nav-link " href="#">Change Password</a></button>
                          </li>

                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#noticsModal"><a class="nav-link " href="#">Info</a></button>
                          </li>

                        </ul>
                    </nav>

            <ul class="breadcrumb">
            <a href="{{ route('profile.show', Auth::user()->id) }}"><li>Profile</li></a> /
            <li class="active">Profile details</li>
            </ul>


            <div class="card-body cbody">
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="form-group" style="width: px; background-color: #E6E6FA">
                    <center><legend class="border-bottom mb-4">Personal Information</legend></center>

                  <div class="content-section" style="background-color: ; font-size: 18px;">

                      <ul class="list-group">
                        <li class="list-group-item">First name:  {{ $user->name }}</li>
                        <li class="list-group-item ">Last name:  {{ $user->last_name }}</li>
                        <li class="list-group-item">Email:  {{ $user->email }}</li>
                        <li class="list-group-item">Phone:  {{ $user->phone }}</li>
                        <li class="list-group-item">Role:  {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</li>
                        <li class="list-group-item">Status:  {{ $user->active }}</li>
                        <li class="list-group-item">Username:  {{ $user->email }}</li>
                      </ul>
                  </div>
              </fieldset>
            </div>

                <div class="col-md-6">
                  <div class="content-section" style="background-color: ; font-size: 16px;">


                <form method="POST" action="{{ route('profile.update', Auth::user()->id)}}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT')}}

                <fieldset class="form-group" style="width: px; background-color: #87CEEB">
                    <center><legend class="border-bottom mb-4">Change Information</legend></center>
                  <div class="content-section" style="background-color: ; font-size: 18px;">

                        <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                        <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? $user->last_name }}" required autocomplete="last_name" autofocus>

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" maxlength="10" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone }}" required autocomplete="phone" autofocus>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gend" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                    <div class="col-md-6">
                                        <select id="gender" type="text" class="form-control @error('gend') is-invalid @enderror" name="gender">
                                            <option value="{{ $user->gender }}">{{ $user->gender }}</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                  <center><button type="submit" class="btn btn-primary">Update</button></center>
                                </div>
                        </fieldset>
                    </form>
                </div>
                </div>
                <small style="color: red; padding-left: 15px;">Your data are kept save by Remson and do not share your password with anyone</small>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection
