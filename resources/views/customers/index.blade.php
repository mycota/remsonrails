@extends('layouts.navbar', ['title' => 'Customers list',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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

                <div class="card-body" style="border: 1px solid #2F4F4F; ">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>
                    <table class="table table-bordered table-hover">
                      <thead style="background-color: #778899">
                        <tr>
                          <th scope="col">Customer name</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Email</th>
                          <th scope="col">Address</th>
                          <th scope="col">Add by</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->cust_name }}</td>
                                <td>{{ $customer->cust_phone }}</td>
                                <td>{{ $customer->cust_email }}</td>
                                <td>{{ $customer->cust_address }}</td>
                                <td>{{ $customer->userscust->name }}</td>
                                <td>
                                  <a href="{{ route('orders.edit', $customer->id)}}" class="float-left">
                                    <button type="button" class="btn btn-info btn-sm">Place Order</button>
                                  </a> 
                                  <a href="{{ route('customers.edit', $customer->id)}}" class="float-left">
                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                  </a> 

                                  <a href="{{ route('orders_sumry.show', $customer->id) }}" class="float-left">
                                    <button type="button" class="btn btn-info btn-sm">Transaction history</button>
                                  </a>

                                  <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="float-left" action="">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <center>{{ $customers->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
