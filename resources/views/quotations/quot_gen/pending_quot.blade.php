@extends('layouts.app', ['title' => 'Pending Quotations',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px; background-color: @hasrole('Accounts') #008b9e @endhasrole;">
                        <ul class="nav nav-pills addcolor">
                            @include('layouts.quotation_head')
                        </ul>
                    </nav>



            <ul class="breadcrumb">
            <a href="{{ route('quotations.index') }}"><li>Pending Quotations</li></a> /
            <li class="active">Peding Quotations</li>
            </ul>

                <div class="card-body cbody">
                @if($orders->isNotEmpty())
                  <input class="form-control" id="myInput" type="text" placeholder="Search for a quotation">
                  <br>
                    @foreach($orders as $order)
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title"><strong>Date:</strong> {{ date('d-m-Y',strtotime($order->created_at)) }}</h5>
                                <h5 class="card-title"><strong>Client:</strong> {{ $order->custquot->customer_name }}</h5>
                                <h5 class="card-title"><strong>Client Phone:</strong> {{ $order->custquot->phone }}</h5>
                                <h5 class="card-title"><strong>Glass Type(s) </strong>{{ implode(', ', $order->order_glass_types()->get()->pluck('glasstype')->toArray()) }}</h5>
                                <h5 class="card-title"><strong>No. of Products:</strong> {{ $order->noOfRailing }}</h5>
                                <h5 class="card-title"><strong>Quotation No:</strong> {{ $order->quotOrdID }}</h5>
                                <h5 class="card-title"><strong>Created by:</strong> {{ $order->userquot->name }} {{ $order->userquot->last_name }} </h5><hr>
                                <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                                <table class="table table-hover">
                                  <thead style="background-color: #F0F8FF">
                                    <tr>
                                      <th scope="col">Product Details</th>
                                      <th scope="col">Product Color</th>
                                      <th scope="col">Handrail</th>
                                      <!-- <th scope="col">Bracket</th> -->
                                    </tr>
                                  </thead>
                                  <tbody id="myTable">
                                        <tr>
                                            <td hidden="">{{ $order->id }} </td>
                                            <td>
                                            {{ implode(', ', $order->order_product_details()->get()->pluck('productName')->toArray())
                                              }}

                                            </td>
                                            <td>
                                            {{ implode(', ', $order->order_product_colors()->get()->pluck('productColor')->toArray())
                                              }}

                                          </td>

                                          <td>
                                            {{ implode(', ', $order->order_product_details()->get()->pluck('handRail')->toArray())
                                              }}
                                          </td>

                                          </tr>
                                        </tbody>
                                      </table>
                                  @include('layouts.quotation_actions')


                                  {{--                                <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id)}}" class="card-link">Raw Quotation</a>--}}
{{--                                @hasrole('Admin')<a href="{{ route('quotations.quot_gen.generatequot', $order->id)}}" class="card-link">Generate Quotation</a>@endhasrole--}}
                              </div>
                            </div>
                    @endforeach
                    <center>{{ $orders->links() }}</center>

                @else
                    <strong style="color: red">No pending quotation data for this account</strong>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
