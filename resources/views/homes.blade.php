@extends('layouts.app', ['title' => 'User list'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark " style="font-size: 16px;">
                        <ul class="nav nav-pills">
                          <li class="nav-item">
                            <button><a class="nav-link " href="#">User Management</a></button>
                          </li>

                          <li class="nav-item">
                            <button><a class="nav-link " href="#">Add User</a></button>
                          </li>
                          <li class="nav-item">
                            <button><a class="nav-link " href="#">User logs</a></button>
                          </li>
                        </ul>
                    </nav>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <h2>Current Users List</h2>
                <table class="table table-bordered table-hover">
                  <thead class="thback" style="background-color: #778899">
                    <tr>
                        <th scope="col">Name</th>
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
                            <td>{{ $user->name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left"><button type="button" class="btn btn-primary btn-sm">Edit Role</button></a>

                            <a href="{{ route('admin.users.edituser', $user->id) }}" class="float-left">
                            <button type="button" class="btn btn-info btn-sm">Edit User</button>
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="float-left">
                            @csrf
                                {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-warning disabled btn-sm">Delete</button>
                            </form>
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
