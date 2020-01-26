@extends('layouts.navbar', ['title' => 'User list'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark " style="font-size: 16px;">
                        <ul class="nav nav-pills">
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
                


                <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                      Launch demo modal
                    </button>
 -->
                    <!-- Modal -->
                    
                    @include('modals.editUserModal')

                    

                <div class="card-body">
                    
                <h2>Current Users List</h2>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
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
                  <tbody>
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
                            <td>
                            <a href="{{ route('admin.roles_status.edit', $user->id) }}" class="float-left"><button type="button" class="btn btn-primary btn-sm">Edit Role</button></a> 

                            <a href="#" class="float-left">
                            <button type="button" class="btn btn-info btn-sm editbtn">Edit User</button>
                            </a> 
                            <!-- editbtn -->

                            <a href="#" class="float-left">
                            <button type="button" class="btn btn-warning btn-sm deletbtn">Delete</button></a>
                            
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
