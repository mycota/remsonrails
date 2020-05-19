@extends('layouts.app', ['title' => 'Update Role and Status',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                        <ul class="nav nav-pills addcolor">
                          <li class="nav-item">
                            <button><a class="nav-link " href="{{ route('products.index') }}">Porducts Management</a></button>
                          </li>

                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#addProductModal"><a class="nav-link " href="#">Add product</a></button>
                          </li>

                        </ul>
                    </nav>
            <ul class="breadcrumb">
            <a href="{{ route('products.index') }}"><li>Products Management</li></a> /
            <li class="active">Product type & description</li>
            </ul>


                  <div class="card-header" style="background-color: #4682B4; color: white;">

                    <center><h2>{{$products->product_name}}</h2></center>
                  </div>

                <div class="card-body cbody" style="border: 1px solid gray; box-shadow: 0px 0px 0px gray;">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" id="insert_type#">

                <fieldset class="form-group" style="width: px; background-color: ">
                    <center><legend class="border-bottom mb-4">Product type</legend></center>
                  <div class="content-section" style="background-color: ; font-size: 18px;">
                    <div class="table-repsonsive">
                        <span id="derror"></span>
                        <!-- <input id="try" type="" name=""> -->
                    <table class="table table-bordered table-hover" id="item_table">
                      <tr>
                        <th class="add#"><a>Click here or the button to add input fields</a></th>
                        <th><button disabled="" type="button" name="add" class="btn btn-info btn-sm add" style="cursor: none;"><span class="glyphicon glyphicon-plus">Add fields</span></button></th>
                      </tr>
                    </table>
                    <input type="text" name="item" id="at" value="AddType" hidden="">
                    <input type="text" name="prod" id="prodid" value="{{$products->id}}" hidden="">

                    <center><button disabled="" type="submit" class="btn btn-primary" style="cursor: none;">Add type</button></center>
                                </div>
                        </fieldset>
                    </form>
                    <hr>

                    <table class="table table-bordered table-hover" id="loadType">
                      <thead style="background-color: #8FBC8F">
                        <tr>
                          <th scope="col">Type</th>
                          <th scope="col">Date</th>
                          <th hidden scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{ $type->type}}</td>
                                <td>{{ date('d-m-Y h:m:s',strtotime($type->created_at)) }}</td>
                                <td hidden>
                                  <style type="text/css">
                                    .acolor{color: #6495ED;}
                                    .del{color: red;}
                                  </style>
                                  <!-- {{ route('products.destroy', $type->id) }} -->
                                  <form action="#" method="POST" class="float-left">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="item" value="Type">
                                    <input type="hidden" name="id" value="{{$products->id}}">

                                    <button type="submit" class="del">Delete</button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <center>{{ $types->links() }}</center>

            </div>



                <div class="col-md-6">
                  <div class="content-section" style="background-color: ; font-size: 16px;">


                <form method="POST" id="insert_despt#">
                                @csrf
                                {{ method_field('PUT')}}

                <fieldset class="form-group" style="width: px; background-color: ">
                    <center><legend class="border-bottom mb-4">Product description</legend></center>
                  <div class="content-section" style="background-color: ; font-size: 18px;">

                        <div class="table-repsonsive">
                        <span id="dderror"></span>

                    <table class="table table-bordered table-hover" id="item_tabled">
                      <tr>
                        <th class="addd#"><a>Click here or the button to add input fields</a></th>
                        <th><button disabled="" type="button" name="addd" class="btn btn-info btn-sm addd" style="cursor: none;"><span class="glyphicon glyphicon-plus">Add fields</span></button></th>
                      </tr>
                    </table>
                    <input type="text" name="item" id="ad" value="AddDespt" hidden="">
                    <input type="text" name="prod" id="prodid" value="{{$products->id}}" hidden="">



                  <center><button disabled="" type="submit" class="btn btn-primary" style="cursor: none;">Add description</button></center>
                  </div>
                </fieldset>
                </form>
                <hr>
                <table class="table table-bordered table-hover">
                      <thead style="background-color: #8FBC8F">
                        <tr>
                          <th scope="col">Description</th>
                          <th scope="col">Date</th>
                          <th hidden scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($descriptions as $description)
                            <tr>
                                <td>{{ $description->description}}</td>
                                <td>{{ date('d-m-Y h:m:s',strtotime($description->created_at)) }}</td>
                                <td hidden>
                                  <style type="text/css">
                                    .acolor{color: #6495ED;}
                                    .del{color: red;}
                                  </style>

                                  <!-- {{ route('products.destroy', $description->id) }} -->
                                  <form action="#" method="POST" class="float-left">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="item" value="Despt">
                                    <input type="hidden" name="id" value="{{$products->id}}">

                                    <button type="submit" class="del">Delete</button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <center>{{ $descriptions->links() }}</center>

                </div>
                </div>

            </div>
        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
