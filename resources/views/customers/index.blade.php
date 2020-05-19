@extends('layouts.app', ['title' => 'Customers list',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])

<!-- remsonrails/storage/app/public/uploads/customized_images/ -->


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <?php

            ?>
            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px; background-color: @hasrole('Accounts') #008b9e @endhasrole;">
                        <ul class="nav nav-pills addcolor">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('customers.index') }}">Customer Management</a></button>
                          </li>
                            @hasrole('Admin')
                            <li class="nav-item">
                                <button data-toggle="modal" data-target="#addCustomerModal"><a class="nav-link getCountryList" href="#">Add customer</a></button>
                            </li>
                            <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('transports.index') }}">Transporters</a></button>
                            </li>
                            @endhasrole
                            @hasrole('Accounts')

                            <li class="nav-item">
                                <button><a class="nav-link " href="{{ route('transports.index') }}">Transporters</a></button>
                            </li>
                            @endhasrole
                            @hasrole('Sales')
                            <li class="nav-item">
                                <button data-toggle="modal" data-target="#addCustomerModal"><a class="nav-link getCountryList" href="#">Add customer</a></button>
                            </li>
                            @endhasrole
                        </ul>
                    </nav>

            @include('modals.editCustomerModal')


            <ul class="breadcrumb">
            <a href="{{ route('customers.index') }}"><li>Customers</li></a> /
            <li class="active">Customer Management</li>
            </ul>

                <div class="card-body cbody">
                    @if($customers->isNotEmpty())
                  <input class="form-control" id="myInput" type="text" placeholder="Search for a customer">
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
                      <tbody id="myTable">

                        @foreach($customers as $customer)
                            <tr>
                                <td hidden="">{{ $customer->id }} </td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td hidden="">{{ $customer->gender }}</td>
                                <td hidden="">{{ $customer->pincode }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->place }}</td>
                                <td hidden="">{{ $customer->countrylist->id }}</td>
                                <td hidden="">{{ $customer->countrylist->country }}</td>
                                <td>{{ $customer->userscust->name }} {{ $customer->userscust->last_name }}</td>
                                <td style="padding-left: 15px; width: 30%;">
                                  <style type="text/css">
                                    /*.acolor{color: #6495ED;}
                                    .del{color: red;}*/
                                  </style>
                                    @if(Auth::user()->hasAnyRoles(['Admin', 'Sales']))
                                  <a href="{{ route('quotations.show', $customer->id) }}" class="float-left" >
                                    <button type="button" class="btn btn-info btn-sm acolor">Order</button>&emsp;
                                  </a>
                                  <a href="#" class="float-left">
                                    <button type="button" class=" btn btn-primary btn-sm acolor editCustbtn">Edit</button>&emsp;
                                  </a>
                                  @else

                                  @endif

                                  <a href="{{ route('customers.show', $customer->id) }}" class="float-left">
                                    <button type="button" class="btn btn-info btn-sm acolor">Trans history</button>&emsp;
                                  </a>

{{--                                  <a href="#" class="float-left" ><form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="float-left" action="">--}}
{{--                                    @csrf--}}
{{--                                    {{ method_field('DELETE') }}--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm del">Delete</button>--}}
{{--                                  </form></a>--}}
                                </td>
                            </tr>
                        @endforeach
                @else
                    <tr><td colspan="7"><strong style="color: red">No customers data for this account</strong></td></tr>
                @endif
                      </tbody>
                    </table>
                    <center>{{ $customers->links() }}</center>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
