@extends('layouts.app', ['title' => 'Update Role and Status',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                        <ul class="nav nav-pills addcolor">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('admin.users.index') }}">User Management</a></button>
                          </li>

                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#addUserModal"><a class="nav-link " href="#">Add User</a></button>
                          </li>
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('admin.logs.index') }}">User logs</a></button>
                          </li>
                        </ul>
                    </nav>
            <ul class="breadcrumb">
            <a href="{{ route('admin.users.index') }}"><li>User Management</li></a> /
            <li class="active">User role and status</li>
            </ul>


                  <div class="card-header" style="background-color: gray; color: white;">

                    <center><h2>Update Role</h2></center>
                  </div>

                <div class="card-body cbody">
                    <form action="{{ route('admin.roles_status.update', ['user' => $user->id]) }}" method="POST">
                      @csrf
                      {{ method_field('PUT') }}
                      <center><fieldset><hr>

                      <div class="row"  >

                      <div class="col-lg-6">
                        <h3>User role</h3>

                      @foreach($roles as $role)

                        <div class="form-check">
                          <input type="radio" name="roles" value="{{ $role->id }}" {{ $user->hasAnyRole($role->name)?'checked':'' }}>
                          <label>{{ $role->name }}</label>
                        </div>
                      @endforeach
                </div>

                <div class="col-lg-6">

                        <h3>User status</h3>


                        <div class="form-check">
                                <label class="radio-inline">
                                <input type="radio" name="active" value="1" {{ ($user->active=="Active")? "checked" : "" }}> Active
                              </label>
                        </div>

                        <div class="form-check">

                          <label class="radio-inline">
                                <input type="radio" name="active" value="0"  {{ ($user->active=="Inactive")? "checked" : "" }}> Inactive
                              </label>
                        </div>

                      <br>
                </div>
              </div>
                      <button type="submit" class="btn btn-primary">Update</button>

              </fieldset></center>


              </form>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
