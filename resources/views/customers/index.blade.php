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
                            <button><a class="nav-link " href="{{ route('customers.index') }}">Customer Management</a></button>
                          </li>
                          
                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#addCustomerModal"><a class="nav-link " href="#">Add customer</a></button>
                          </li>
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('admin.logs.index') }}">Transporters</a></button>
                          </li> 
                        </ul>
                    </nav>

            @include('modals.editCustomerModal')

            
            <ul class="breadcrumb">
            <a href="{{ route('customers.index') }}"><li>Customers</li></a> /
            <li class="active">Customer Management</li>
            </ul>

                <div class="card-body" style="border: 1px solid #2F4F4F; ">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>
                    <table class="table table-bordered table-hover">
                      <thead style="background-color: #5F9EA0">
                        <tr>
                          <th scope="col">Customer name</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Email</th>
                          <th scope="col">Billing Address</th>
                          <th scope="col">Place</th>
                          <th scope="col">Add by</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td hidden="">{{ $customer->id }} </td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td hidden="">{{ $customer->gender }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->place }}</td>
                                <td>{{ $customer->userscust->name }} {{ $customer->userscust->last_name }}</td>
                                <td>
                                  <style type="text/css">
                                    .acolor{color: #6495ED;}
                                    .del{color: red;}
                                  </style>
                                  <a href="#" class="acolor" >
                                    <button type="button" class="acolor">Place Order</button>
                                  </a> 
                                  <a href="#" class="float-left">
                                    <button type="button" class="acolor editCustbtn">Edit</button>
                                  </a> 

                                  <a href="#" class="float-left">
                                    <button type="button" class="acolor">Transaction history</button>
                                  </a>

                                  <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="float-left" action="">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="del">Delete</button>
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
