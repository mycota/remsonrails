@extends('layouts.navbar', ['title' => 'Quotations',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark " style="font-size: 16px;">
                        <ul class="nav nav-pills">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('quotations.index') }}"> Quotations</a></button>
                          </li>
                          
                          <li class="nav-item">
                            <button ><a class="nav-link addQuot" href="#">Site Measurement</a></button>
                          </li>

                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#addTransporterModal"><a class="nav-link " href="#">Pending orders</a></button>
                          </li>
                           
                        </ul>
                    </nav>

            @include('modals.editCustomerModal')

            
            <ul class="breadcrumb">
            <a href="{{ route('quotations.index') }}"><li>Quotations</li></a> /
            <li class="active">Quotations</li>
            </ul>

                <div class="card-body" style="border: 1px solid #00008B; ">
                  <br>

                @foreach($transports as $transport)
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Client: {{ $transport->transport }}</h4><hr>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                    <table class="table table-hover">
                      <thead style="background-color: #F0F8FF">
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Glass Details</th>
                          <th scope="col">Product Details</th>
                          <th scope="col">Color Details</th>
                        </tr>
                      </thead>
                      <tbody>
                            <tr>
                                <td hidden="">{{ $transport->id }} </td>
                                <td>{{ date('d-m-Y h:m:s',strtotime($transport->created_at)) }}</td>

                                <td>{{ $transport->transport }}</td>
                                <td>{{ $transport->description }}</td>
                                <td>{{ $transport->userstransp->name }} {{ $transport->userstransp->last_name }}</td>
                              </tr>
                            </tbody>
                          </table>

                    <a style="" href="#" class="card-link">Review</a>
                    <a href="#" class="card-link">Add price</a>
                  </div>
                </div>
                @endforeach
                <hr>
                    <center>{{ $transports->links() }}</center>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
