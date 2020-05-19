@extends('layouts.app', ['title' => 'User list', 'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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
            <a href="{{ route('admin.users.index') }}"><li>Users</li></a> /
            <li class="active">User Management</li>
            </ul>

                    @include('modals.editUserModal')



                <div class="card-body cbody">

                <!-- <h2>Current Users List</h2> -->
                <input class="form-control" id="myInput" type="text" placeholder="Search for a user">
                <br>
                <table class="table table-bordered table-hover">
                  <thead class="thback" style="background-color: #778899">
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                      @foreach($users as $user)
                        <tr class="table">
                            <td hidden="">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td hidden="">{{ $user->gender }}</td>
                            <td>{{ $user->active }}</td>
                            <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td style="padding-left: 45px;">
                            @if(Auth::user()->id == $user->id or $user->email_verified_at == null)
                                    <a href="{{ route('admin.roles_status.edit', $user->id) }}" class="float-left"><button disabled="" type="button" class="btn btn-primary btn-sm">Edit Role</button>&emsp;</a>
                            @else

                                <a href="{{ route('admin.roles_status.edit', $user->id) }}" class="float-left"><button type="button" class="btn btn-primary btn-sm">Edit Role</button>&emsp;</a>
                            @endif


                            <a href="#" class="float-left">
                            <button type="button" class="btn btn-info btn-sm editbtn">Edit User</button>&emsp;
                            </a>
                            <!-- editbtn -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                            <button type="button" class="btn btn-info btn-sm">Trans</button>&emsp;
                            </a>

                                <a href="{{ route('admin.logs.show', $user->id) }}" class="float-left"><button type="button" class="btn btn-primary btn-sm">Logs</button>&emsp;</a>

                            @if(Auth::user()->id == $user->id)
                                <a href="#" class="float-left">
                                <button type="button" disabled="" class="btn btn-danger btn-sm deletbtn">Delete</button></a>
                            @else
                                <a href="#" class="float-left">
                                <button type="button" class="btn btn-danger btn-sm deletbtn">Delete</button></a>
                            @endif

                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                <center>{{ $users->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
