@extends('layouts.app', ['title' => 'User Activities', 'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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
            <a href="{{ route('admin.users.edit', $user->id) }}"><li>User Activities</li></a> /
            <li class="active">User activities for <strong>{{$user->name}} {{$user->last_name}}</strong></li>
            </ul>

{{--                    @include('modals.editUserModal')--}}
                <div class="card-body cbody">

                <!-- <h2>Current Users List</h2> -->
                <input class="form-control" id="myInput" type="text" placeholder="Search for a user">
                <br>
                <table class="table table-bordered table-hover">
                  <thead class="thback" style="background-color: #A9A9A9; font-size: 16px;">
                    <tr>
                        <th scope="col" colspan="3" style="text-align: center"> Customers and Log history</th>

                    </tr>
                  </thead>
                  <tbody id="myTable">
                        <tr class="table">
                            <td>Customers</td>
                            <td>{{ $numbers[0] }}</td>
                            <td>
                                <a href="#" class="float-left">
                            <button type="button" disabled class="btn btn-info btn-sm editbtn">View</button>
                            </a></td>
                        </tr>
                        <tr>
                            <td>Logs</td>
                            <td>{{ $numbers[1] }}</td>
                            <td>
                                <a href="{{ route('admin.logs.show', $user->id) }}" class="float-left">
                            <button type="button" class="btn btn-info btn-sm editbtn">View</button>
                            </a></td>

                        </tr>
                  <tr>
                      <th colspan="3"></th>
                  </tr>
                        <tr>
                      <th colspan="3" style="text-align: center; background-color: #DCDCDC; font-size: 16px;">Quotations</th>
                  </tr>
                  <tr class="table">
                            <td>Pending quotations</td>
                            <td>{{ $numbers[2] }}</td>
                            <td>
                                <a href="#" class="float-left">
                            <button type="button" disabled class="btn btn-info btn-sm editbtn">View</button>
                            </a></td>
                        </tr>
                        <tr>
                            <td>Prepared quotations</td>
                            <td>{{ $numbers[3] }}</td>
                            <td>
                                <a href="#" class="float-left">
                            <button type="button" disabled class="btn btn-info btn-sm editbtn">View</button>
                            </a></td>

                        </tr>
                        <tr>
                            <td>Confirmed quotations</td>
                            <td>{{ $numbers[4] }}</td>
                            <td>
                                <a href="#" class="float-left">
                                    <button type="button" disabled class="btn btn-info btn-sm editbtn">View</button>
                                </a></td>

                        </tr>
                        <tr>
                            <td>Transported quotations</td>
                            <td>{{ $numbers[5] }}</td>
                            <td>
                                <a href="#" class="float-left">
                                    <button type="button" disabled class="btn btn-info btn-sm editbtn">View</button>
                                </a></td>

                        </tr>
                        <tr>
                            <td>All quotations (all combined)</td>
                            <td>{{ $numbers[6] }}</td>
                            <td>
                                <a href="#" class="float-left">
                            <button type="button" disabled class="btn btn-info btn-sm editbtn">View</button>
                            </a></td>

                        </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
