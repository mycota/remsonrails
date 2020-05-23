@extends('layouts.app', ['title' => 'Transported Quotations',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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
            <a href="{{ route('quotations.trans.transported_quot') }}"><li>Transported Quotations</li></a> /
            <li class="active">Transported Quotations</li>
            </ul>

                <div class="card-body cbody">
                @if($orders->isNotEmpty())

                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <br>


                    @foreach($orders as $order)
                    <div class="card">
                      <div class="card-body">
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                        <table class="table table-hover">
                          <thead style="background-color: #4682B4">
                            <tr style="color: white;">
                              <th scope="col">Date</th>
                              <th scope="col">Qout. No.</th>
                              <th scope="col">Customer</th>
                              <th scope="col">Transporter</th>
                              <th scope="col">By</th>


                              <!-- <th scope="col">Bracket</th> -->
                            </tr>
                          </thead>
                          <tbody >
                                <tr>
                                    <td>{{ date('d-m-Y',strtotime($order->order_trans->date )) }} </td>
                                    <td>{{ $order->order_final_quot->quotOrdID }} </td>
                                    <td>{{ $order->custquot->customer_name }}</td>

                                    <td>{{ $order->order_trans->trans_tranport->transport }}</td>
                                    <td>{{ $order->order_trans->users->name }}</td>
                                  </tr>
                                </tbody>
                              </table>
                          @include('layouts.quotation_actions')


                          {{--                        <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>--}}
{{--                        <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>--}}
{{--                        <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>--}}
{{--                          @hasrole('Accounts')<a style="color: #8B008B" href="#" class="card-link">Add Transport</a>@endhasrole--}}
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
