@extends('layouts.app', ['title' => 'Transaction history',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])

<!-- remsonrails/storage/app/public/uploads/customized_images/ -->


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

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

{{--            @include('modals.editCustomerModal')--}}


            <ul class="breadcrumb">
            <a href="{{ route('customers.show', $customer->id) }}"><li>Transaction history</li></a> /
            <li class="active">Customer transaction history for <strong>{{ $customer->customer_name }}</strong></li>
            </ul>
                <div class="card-body cbody">
                    @if($custQuots->isNotEmpty())
                      <input class="form-control" id="myInput" type="text" placeholder="Search for a customer">
                      <br>
                        <table class="table table-bordered table-hover">
                          <thead style="background-color: #5F9EA0">
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Quotation ID</th>
                              <th scope="col">No. of Products</th>
                              <th scope="col">Approx RFT.</th>
                              <th scope="col">Status</th>
                              <th scope="col">Worked on by</th>
    {{--                          <th scope="col">Last update</th>--}}
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody id="myTable">
                          <?php
                            function getColor($status){
                                if ($status === 'Pending'){ return 'red';}
                                if ($status === 'Transported'){ return 'green';}
                                if ($status === 'Prepared'){ return 'black';}
                                if ($status === 'Confirmed'){ return '#8B4513';}
                                if ($status === 'Prepared'){ return 'black';}
                            }
                           ?>
                            @foreach($custQuots as $custQuot)
                                <tr style="color: <?php echo getColor($custQuot->orderStatus); ?>">
                                    <td >{{ date('d-m-Y',strtotime($custQuot->created_at )) }} </td>
                                    <td>{{ $custQuot->quotOrdID }}</td>
                                    <td>{{ $custQuot->noOfRailing }}</td>
                                    <td>{{ $custQuot->approxiRFT }}</td>
                                    <td>{{ $custQuot->orderStatus }}</td>
                                    <td>{{ $custQuot->userquot->name }}</td>
    {{--                                <td>{{ date('d-m-Y',strtotime($custQuot->updated_at )) }}</td>--}}
                                    <td style="padding-left: ; width: 350px;">
                                      <style type="text/css">
                                        /*.acolor{color: #6495ED;}
                                        .del{color: red;}*/
                                      </style>
                                      <a href="{{ route('quotations.quot_gen.rawquot', $custQuot->id) }}" class="float-left" >
                                        <button type="button" class="btn btn-info btn-sm acolor">Raw Quotation</button>&emsp;
                                      </a>

                                        @if($custQuot->orderStatus === 'Pending')
                                            <a href="{{ route('quotations.quot_gen.finalquotationpdf', $custQuot->id) }}" class="float-left">
                                                <button type="button" disabled class=" btn btn-primary btn-sm acolor editCustbtn">View Quotation</button>&emsp;
                                            </a>

                                            <a href="{{ route('quotations.quot_gen.downloadpdf', $custQuot->id)}}" class="float-left">
                                            <button type="button" disabled class="btn btn-success btn-sm acolor">Quotation PDF</button>
                                            </a>
                                        @else
                                            <a href="{{ route('quotations.quot_gen.finalquotationpdf', $custQuot->id) }}" class="float-left">
                                                <button type="button" class=" btn btn-primary btn-sm acolor editCustbtn">View Quotation</button>&emsp;
                                            </a>
                                            <a href="{{ route('quotations.quot_gen.downloadpdf', $custQuot->id)}}" class="float-left">
                                            <button type="button" class="btn btn-success btn-sm acolor">Quotation PDF</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <center>{{ $custQuots->links() }}</center>
                    @else
                        <strong style="color: red">No transaction history for this customer </strong>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
