@extends('layouts.app', ['title' => 'All Quotations',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-12">

                <div class="card" >
                    <div class="card-header" style="background-color: ;">
                        <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                            <ul class="nav nav-pills addcolor">
                                @include('layouts.quotation_head')
                            </ul>
                        </nav>

                        <ul class="breadcrumb">
                            <a href="{{ route('quotations.index') }}"><li>Prepared Quotations</li></a> /
                            <li class="active">Prepared Quotations</li>
                        </ul>

                        <div class="card-body cbody">
                            @if($orders->isNotEmpty())

                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                <br>

                                @foreach($orders as $order)
                                    <div class="card ">
                                        <div class="card-body ">

                                            <table class="table table-hover myTable" >
                                                <thead style="background-color: #ADD8E6" class="myTable">
                                                <tr class="myTable">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Qout. No.</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">No. Products</th>
                                                    <th scope="col">Approx RFT.</th>
                                                    <th scope="col">Status.</th>
                                                    <th scope="col">By</th>
                                                </tr>
                                                <?php
//                                                    function changeColor($status){
//                                                        if ($status === 'Pending'){
//                                                            return 'red';
//                                                        }
//                                                        if ($status === 'Prepared'){
//                                                            return 'black';
//                                                        }
//                                                        if ($status === 'Transported'){
//                                                            return 'green';
//                                                        }
//                                                    }
                                                ?>
                                                </thead>
                                                <tbody class="myTable">
                                                <tr style="color: @if($order->orderStatus == 'Pending') red @elseif($order->orderStatus == 'Prepared') black @elseif($order->orderStatus == 'Transported') green @elseif($order->orderStatus == 'Confirmed') #8B4513 @endif " class="myTable">
                                                    <td>{{ date('d-m-Y',strtotime($order->created_at )) }} </td>
                                                    <td>{{ $order->quotOrdID }} </td>
                                                    <td>{{ $order->custquot->customer_name }}</td>

                                                    <td>{{ $order->noOfRailing }}</td>
                                                    <td>{{ $order->approxiRFT }}</td>
                                                    <td>{{ $order->orderStatus }}</td>
                                                    <td>{{ $order->userquot->name }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            @include('layouts.quotation_actions')
{{--                                            @if($order->orderStatus == 'Pending')--}}
{{--                                                <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>--}}
{{--                                                @hasrole('Admin')<a href="{{ route('quotations.quot_gen.generatequot', $order->id)}}" class="card-link">Generate Quotation</a>@endhasrole--}}

{{--                                            @elseif($order->orderStatus == 'Prepared')--}}
{{--                                                <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>--}}
{{--                                                <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>--}}
{{--                                                <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>--}}
{{--                                                @hasrole('Accounts')<a style="color: #8B008B" href="#" class="card-link">Add Transport</a>@endhasrole--}}

{{--                                            @elseif($order->orderStatus == 'Transported')--}}
{{--                                            <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>--}}
{{--                                            <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>--}}
{{--                                            <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>--}}
{{--                                            <a style="color: chocolate" href="#" class="card-link">Invoices</a>--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <center>{{ $orders->links() }}</center>

                            @else
                                <strong style="color: red">No prepared quotation data for this account</strong>
                            @endif
                        </div>
                        </div>
                </div>
            </div>
        </div>
@endsection
