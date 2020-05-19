@extends('layouts.app', ['title' => 'Produsts list',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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
                          @hasrole('Admin')
                          <li class="nav-item">
                            <button data-toggle="modal" data-target="#addProductModal"><a class="nav-link " href="#">Add product</a></button>
                          </li>
                          @endhasrole

                        </ul>
                    </nav>

            @include('modals.editProductModal')


            <ul class="breadcrumb">
            <a href="{{ route('products.index') }}"><li>Products</li></a> /
            <li class="active">Products Management</li>
            </ul>

                <div class="card-body cbody">
                  <input class="form-control" id="myInput" type="text" placeholder="Search for a product">
                  <br>
                    <table class="table table-bordered table-hover">
                      <thead style="background-color: #4682B4">
                        <tr>
                          <th scope="col">Product name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Type</th>
                          <th hidden scope="col">QTY</th>
                          <th scope="col">PCS/RFT</th>
                          <th scope="col">Add by</th>
                          @hasrole('Admin') <th scope="col">Actions</th> @endhasrole
                        </tr>
                      </thead>
                      <tbody id="myTable">
                        @foreach($products as $product)
                            <tr>
                                <td hidden="">{{ $product->id }} </td>
                                <td>{{ $product->product_name }}</td>
                                <td><select class="form-control">
                                  @foreach($product->product_despt()->get()->pluck('description')->toArray() as $despt)
                                  <option>{{ $despt }}</option>
                                  @endforeach
                                </select></td>
                                <td><select class="form-control">
                                  @foreach($product->product_type()->get()->pluck('type')->toArray() as $type)
                                  <option>{{ $type }}</option>
                                  @endforeach
                                </select></td>
                                <td hidden>{{ $product->qty }}</td>
                                <td>{{ $product->pcs_rft }}</td>
                                <td>{{ $product->userprod->name }} {{ $product->userprod->last_name }}</td>
                                @hasrole('Admin')
                                <td>
                                  <style type="text/css">
                                    .acolor{color: #6495ED;}
                                    .del{color: red;}
                                  </style>

                                  <!-- <a href="#" class="float-left">
                                    <button type="button" class="acolor editProdbtn">Edit</button>
                                  </a>
 -->
                                  <a href="{{ route('products.edit', $product->id )}}" class="float-left">
                                    <button type="button" class="acolor">Manage</button>
                                  </a>


                                  <!-- <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="float-left">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="del">Delete</button>
                                  </form> -->
                                </td>
                                @endhasrole
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <center>{{ $products->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
