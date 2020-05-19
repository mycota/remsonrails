@extends('layouts.app', ['title' => 'User list', 'logo' => 'http://192.168.1.150/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                        <ul class="nav nav-pills addcolor">

                        <li class="nav-item">
                            <button data-toggle="modal" data-target="#changePassModal"><a class="nav-link " href="#">Change Password</a></button>
                          </li>

                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('profile.show', Auth::user()->id) }}">Profile</a></button>
                          </li>


                        </ul>
                    </nav>
            <ul class="breadcrumb">
            <a href="{{ route('passwords.edit', Auth::user()->id) }}"><li>Change Password</li></a> /
            <li class="active">Change Password</li>
            </ul>

                <div class="card-body" style="border: 1px solid: #CD5C5C; ">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('passwords.update', Auth::user()->id) }}">
                        @csrf
                        {{ method_field('PATCH')}}
                        <fieldset><center><legend>Change your password</legend></center><hr>

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}"  name="email" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"  name="old_password" required autocomplete="old_password" autofocus>
                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="password-confirm" autofocus>

                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change') }}
                                </button>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
