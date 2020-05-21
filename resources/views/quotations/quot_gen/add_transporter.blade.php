@extends('layouts.app', ['title' => 'Add Transporter',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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
            <a href="{{ route('quotations.quot_gen.add_transporter', 2) }}"><li>Add Transporter</li></a> /
            <li class="active">Add Transporter to Quotations</li>
            </ul>

                <div class="card-body cbody">

                    <div class="card">
                      <div class="card-body">

                          <form method="POST" id="addQuotTrans" action="{{ route('quotations.quot_gen.store_trans_quot') }}" enctype="multipart/form-data">
                              @csrf
                              {{ method_field('POST')}}

                              <fieldset class="form-group" style="width: px; background-color: #C0C0C0">
                                  <center><legend class="border-bottom mb-4">Add Transporter to Quotation</legend></center>
                                  <div class="content-section" style="background-color: ; font-size: 18px;">
                                      <center><span id="return_errors"></span></center>
                                      <div class="form-group row">
                                          <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Job No. / Quotation No.') }}</label>
                                          <div class="col-md-6">
                                              <input id="" type="text" readonly class="form-control" name="quotOrdID" value="{{$order->quotOrdID}}" required autofocus>
                                              <input id="quot_id" type="hidden" readonly class="form-control" name="quotOrdID" value="{{$order->id}}" required autofocus>

                                              <span class="invalid-feedback" role="alert">
                                                <strong>{</strong>
                                            </span>

                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                                          <div class="col-md-6">
                                              <input id="date" type="date" class="form-control" name="date" value="" required autofocus>


                                              <span class="invalid-feedback" role="alert">
                                                <strong>{</strong>
                                            </span>

                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Transporter') }}</label>

                                          <div class="col-md-6">
                                              <select id="trans_id" type="text" class="form-control" name="transport">
                                                  @foreach($trans as $tran)
                                                    <option value="{{$tran->id}}">{{$tran->transport }} - {{$tran->description }}</option>
                                                  @endforeach
                                              </select>


                                              <span class="invalid-feedback" role="alert">
                                                <strong>{</strong>
                                            </span>

                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Bill') }}</label>
                                          <div class="col-md-6">
                                              <input id="bill" type="file" class="form-control" name="bill" value="" required autofocus>
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{</strong>
                                            </span>

                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Receipt') }}</label>
                                          <div class="col-md-6">
                                              <input id="receipt" type="file" class="form-control" name="receipt" value="" required autofocus>


                                              <span class="invalid-feedback" role="alert">
                                                <strong>{</strong>
                                            </span>

                                          </div>
                                      </div>


                                      <center><button type="submit" class="btn btn-primary">Update</button></center>
                                  </div>
                              </fieldset>
                          </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
