@extends('layouts.navbar', ['title' => 'Transporters list',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark " style="font-size: 16px;">
                        <ul class="nav nav-pills">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('transports.index') }}"> Transporter Management</a></button>
                          </li>
                          
                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#addTransporterModal"><a class="nav-link " href="#">Add transporter</a></button>
                          </li>
                           
                        </ul>
                    </nav>

            @include('modals.editCustomerModal')

            
            <ul class="breadcrumb">
            <a href="{{ route('transports.index') }}"><li>Transporters</li></a> /
            <li class="active">Transporter Management</li>
            </ul>

                <div class="card-body" style="border: 1px solid #2F4F4F; ">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>
                    <table class="table table-bordered table-hover">
                      <thead style="background-color: #B0E0E6">
                        <tr>
                          <th scope="col">Transport name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Add by</th>
                          <th scope="col">Date</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="myTable">
                        @foreach($transports as $transport)
                            <tr>
                                <td hidden="">{{ $transport->id }} </td>
                                <td>{{ $transport->transport }}</td>
                                <td>{{ $transport->description }}</td>
                                <td>{{ $transport->userstransp->name }} {{ $transport->userstransp->last_name }}</td>
                                <td>{{ date('d-m-Y h:m:s',strtotime($transport->created_at)) }}</td>

                                <td>
                                  <style type="text/css">
                                    .acolor{color: #6495ED;}
                                    .del{color: red;}
                                  </style>
                                  
                                  <a href="#" class="float-left">
                                    <button type="button" class="acolor editCustbtn">Edit</button>
                                  </a> 

                                  <form action="{{ route('transports.destroy', '$transport->id') }}" method="POST" class="float-left" action="">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="del">Delete</button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <center>{{ $transports->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
