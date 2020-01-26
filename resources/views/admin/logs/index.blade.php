@extends('layouts.navbar', ['title' => 'User logs'])


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
                </div>
                <ul class="breadcrumb">
            <a href="{{ route('admin.users.index') }}"><li>Users</li></a> /
            <li class="active">User logs</li>
            </ul>

                <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                      Launch demo modal
                    </button>
 -->
                    <!-- Modal -->
                    

                <div class="card-body">
                    
                <h2>Users Logs</h2>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                <table class="table table-bordered table-hover">
                  <thead class="thback" style="background-color: #778899">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        <th scope="col">Roles</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">Date Time</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($logs as $log)
                        <tr class="table">
                            
                            <td>{{ $log->userlogs->name }} {{ $log->userlogs->last_name }}</td>
                            <td>{{ $log->userlogs->email }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ implode(', ', $log->userlogs->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td>{{ $log->ip_address }}</td>
                            <td>{{ date('d-m-Y h:m:s',strtotime($log->created_at)) }}</td>

                            
                                  
                        </tr>
                      @endforeach    
                  </tbody>
                </table> 
                <center>{{ $logs->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
