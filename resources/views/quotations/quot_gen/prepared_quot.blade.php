@extends('layouts.navbar', ['title' => 'Prepared Quotations',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
          
            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                        <ul class="nav nav-pills addcolor">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('quotations.index') }}">Pending Quotations</a></button>
                          </li>
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('quotations.quot_gen.prepared_quot') }}">Prepared Quotations</a></button>
                          </li>
                          
                          <li class="nav-item">
                            <button ><a class="nav-link addQuot" href="#">Site Measurement</a></button>
                          </li>

                          <!-- <li class="nav-item">
                            <button data-toggle="modal" data-target="#addTransporterModal"><a class="nav-link " href="#">Pending orders</a></button>
                          </li> -->
                           
                        </ul>
                    </nav>


            
            <ul class="breadcrumb">
            <a href="{{ route('quotations.index') }}"><li>Prepared Quotations</li></a> /
            <li class="active">Prepared Quotations</li>
            </ul>

                <div class="card-body" style="border: 1px solid #00008B; ">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>

                @foreach($orders as $order)
                <div class="card">
                  <div class="card-body">
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                    <table class="table table-hover">
                      <thead style="background-color: #097586">
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Qout. No.</th>
                          <th scope="col">Customer</th>
                          <th scope="col">No. Products</th>
                          <th scope="col">Approx RFT.</th>
                          <th scope="col">Prepared by</th>


                          <!-- <th scope="col">Bracket</th> -->
                        </tr>
                      </thead>
                      <tbody id="myTable">
                            <tr>
                                <td>{{ date('d-m-Y',strtotime($order->order_final_quot->created_at )) }} </td>
                                <td>{{ $order->order_final_quot->quotOrdID }} </td>
                                <td>{{ $order->custquot->customer_name }}</td>
                             
                                <td>{{ $order->noOfRailing }}</td>
                                <td>{{ $order->approxiRFT }}</td>
                                <td>{{ $order->order_final_quot->final_quot_user->name }}</td>
                              </tr>
                            </tbody>
                          </table>

                    <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>
                    <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>
                    <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>
                  </div>
                </div>
                @endforeach
                <hr>
                    <center>{{ $orders->links() }}</center>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
