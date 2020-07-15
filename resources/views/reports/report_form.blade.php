@extends('layouts.app', ['title' => 'Quotations Report',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
{{--                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">--}}
{{--                        <ul class="nav nav-pills addcolor">--}}

{{--                            @include('layouts.quotation_head')--}}

{{--                        </ul>--}}
{{--                    </nav>--}}


            <ul class="breadcrumb">
{{--            <a href="#"><li>Report</li></a> /--}}
{{--            <li class="active">Report</li>--}}
                <h1 style="text-align: center; text-decoration: underline">Report Generation Template</h1>
            </ul>

                <div class="card-body cbody">
{{--                @if($orders->isNotEmpty())--}}

                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>


{{--                    @foreach($orders as $order)--}}
                    <div class="card">

                        <div class="card-body">
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            @if($orders->isNotEmpty())
                                <a href="{{ route('reports.pdf.generatePDF', $url) }}" target="_blank" rel="noopener noreferrer" style="font-size:; position:absolute; margin-top: -20px; left: 860px;"><button class="btn btn-warning"><i class="icon-print"></i> Export to PDF</button></a>
                            @else
{{--                                show not the print btn--}}
                            @endif
                            <caption>{{$megs}}.</caption><br><br>

                            <table class="table table-hover table-bordered">
                          <thead style="background-color: #4682B4">
                            <tr style="color: white;">
                              <th scope="col">Date</th>
                              <th scope="col">Qout. No.</th>
                                <th scope="col">Customer</th>
                                <th scope="col">No. of products</th>
                                <th scope="col">Reference by</th>
                                <th scope="col">Transporter</th>
                                <th scope="col">Status</th>
                                <th scope="col">By</th>


                              <!-- <th scope="col">Bracket</th> -->
                            </tr>
                          </thead>
                          <tbody >
                          @if($orders->isNotEmpty())
                              @foreach($orders as $order)
                                <tr>
                                    <td>{{ date('d-m-Y',strtotime($order->created_at )) }} </td>
                                    <td>{{ $order->quotOrdID }} </td>
                                    <td>{{ $order->custquot->customer_name }}</td>
                                    <td>{{ $order->noOfRailing }} </td>
                                    <td>{{ $order->refby }} </td>
                                    @if($order->orderStatus == "Transported")
                                        <td>{{ $order->order_trans->trans_tranport->transport }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $order->orderStatus}}</td>
                                    <td>{{ $order->userquot->name }} {{ $order->userquot->last_name }}</td>

                                </tr>
                              @endforeach
                          @else
                              <td colspan="8"><strong style="color: red">No data found</strong></td>
                          @endif

                                </tbody>
                              </table>
{{--                          @include('layouts.quotation_actions')--}}
                      </div>
                    </div>
{{--                    @endforeach--}}
                    <hr>
{{--                    <center>{{ $orders->links() }}</center>--}}

{{--                @else--}}
{{--                    <strong style="color: red">No prepared quotation data for this account</strong>--}}
{{--                @endif--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
