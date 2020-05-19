@extends('layouts.app', ['title' => 'Site Measurement',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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

            @include('modals.ApproxRFCalTModal')

            <script type="text/javascript">

              function selectoption(){
              var opt1 = document.getElementById("glasstype");
              var opt2 = document.getElementById("glassize1");
              var opt3 = document.getElementById("glassize2");
              var opt4 = document.getElementById("coattype");
              var opt5 = document.getElementById("product_name");
              var opt6 = document.getElementById("prtype");
              // var opt7 = document.getElementById("product_cover");

              if(opt1.value == "") {
                alert("Please select glass type");
                opt1.focus();
                return false;
              }
              if(opt2.value == "") {
                alert("Please select glass size");
                opt2.focus();
                return false;
              }
              if(opt4.value == "") {
                alert("Please select coating type");
                opt4.focus();
                return false;
              }

              if(opt5.value == "") {
                alert("Please select product name");
                opt5.focus();
                return false;
              }

              if(opt6.value == "") {
                alert("Please select product name");
                opt6.focus();
                return false;
              }

              // if(opt7.value == "") {
              //   alert("Please select product cover");
              //   opt7.focus();
              //   return false;
              // }

              return true;

            }

            </script>


            <ul class="breadcrumb">
            <a href="{{ route('quotations.show', $customer->id) }}"><li>Site measurement</li></a> /
            <li class="active">Site measurement</li>
            </ul>

                <div class="card-body" style="border: 1px solid #006400; ">
                  <br>

                    <div id="wrapper">


                        <fieldset class="page-header">
            <!-- <legend>Invoice:</legend> -->
            <div class="pull-right" style="margin-right:100px;">
    <a href="javascript:Clickheretoprint()" style="font-size:20px; position:absolute; margin-top: -35px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>

    <a href="{{ route('pdfs.index') }}" style="font-size:20px; position:absolute; margin-top: -35px; left: 900px"><button class="btn btn-info btn-large"><i class="icon-print"></i> PDF format</button></a>


  <div class="clearfix"></div></div>
                <!-- </div> -->
<form action="{{ route('quotations.store') }}" method="POST" enctype="multipart/form-data" id="fset0">

    @csrf

    <div class="content" id="content">

    <!-- <img style="width: 100%; height: 15%;" src="{{ asset('images/head.jpg') }}"> -->
    <table border="1">

      <tr>
        <th colspan="5" width="1500"><center>Site Measurement Sheet</center></th>
        <?php
          // logs($_SESSION['id'], $_SESSION['username'], "View Site Measurement Sheet.");
        ?>
      </tr>

      <tr>
        <td>Party Name</td>
        <td><input readonly style="width: 100%;" class="td1" type="text" name="customer_name" value="{{ $customer->customer_name }}" required="" placeholder="Enter party name"></td>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        <input type="hidden" name="quotOrdID" value="{{ $quotOrdID }}">
        <td>Date</td>
        <td colspan="2"><input style="width: 100%;" value="<?php echo date('d-m-Y');?>" type="text" name="date" readonly></td>
      </tr>

      <tr>
        <td>Billing Name</td>
        <td><input readonly style="width: 100%;" class="td1" type="text" value="{{ $customer->customer_name }}" required name="billing_name" placeholder="Enter billing name"></td>
        <td>Place</td>
        <td colspan="2"><input style="width: 100%;" value="{{ $customer->place }}" type="text" required="" name="place" placeholder="Enter place"></td>
      </tr>

      <tr>
        <td>Billing Address</td>
          <!-- <td><input class="td1" type="text" required name="billing_address" placeholder="Enter billing address"> -->
        <td rowspan="2">
          <textarea type="text" readonly required name="billing_address" class="td1" rows="3" cols="20" placeholder="Billing address">{{ $customer->address }}</textarea>
        </td>
        <td>Glass</td>
        <td colspan="2">
        <select type="text" class="form-control @error('glassType') is-invalid @enderror" required id="glasstype" name="glassType" onchange="populate(this.id,'glassize1'); populate2('glassize1', 'glassize2')">

            <option value="">Select glass type</option>
            <option value='TOUGHENED'>TOUGHENED</option>
            <option value="LAMINATED">LAMINATED</option>
            <option value="YOUR SCOPE">YOUR SCOPE</option>
            <option value="{{ old('glassType') }}" @if(old('glassType')) selected="selected" @endif >{{ old('glassType') }}</option>


        </select>
        @error('glassType')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror</td>
      </tr>
        <tr><td></td>
        <td>Size</td><td colspan="2">
        <select type="text" class="form-control @error('glasSize1') is-invalid @enderror" required name="glasSize1" id="glassize1" onchange="populate2(this.id,'glassize2')">
        </select>
      @error('glasSize1')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror </td>
      </tr>
      <tr>
        <td>Referance By </td>
        <td><input style="width: 100%;" class=" form-control td1 @error('refby') is-invalid @enderror"  type="text" name="refby" value="{{ old('refby') }}" placeholder="Refered by">
        @error('refby')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror </td>
        <td>Size</td><td colspan="2">
        <select type="text" class="form-control"  name="glasSize2" id="glassize2">
        </select>
        </td>
        </tr>

        <tr>
        <td>Approx. RFT </td>
        <td><input readonly="" id="approxiRFT" style="width: 100%;" class=" form-control td1 @error('approxiRFT') is-invalid @enderror showCal" type="text" name="approxiRFT" value="{{ old('approxiRFT') }}">
         @error('approxiRFT')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror </td>

        </tr>
      </table>

      <table border="1">
        <tr>
          <th colspan="6" width="1500"><center>Final Product Details</center></th>
        </tr>
        <tr>
          <!-- <span>One Product&emsp;</span><input type="radio" checked="" id="one" name="noOfProduct">&emsp;
            <span>Two Products&emsp;</span><input type="radio" id="two" name="noOfProduct">&emsp;
            <span>Three Products&emsp;</span><input type="radio" id="three" name="noOfProduct">&emsp;
            <span>Four Products&emsp;</span><input type="radio" id="four" name="noOfProduct"> -->
          <td>Product Name</td>
          <td>
            <select required name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" id="product_name" onchange="products(this.id,'prtype'); productscover('prtype','product_cover')">
              <option value="">Select product name</option>
              <option value="SMART LINE CONTINUE PROFILE">SMART LINE</option>
              <option value="SEA LINE BRACKET PROFILE">SEA LINE</option>
              <option value="SQUARE LINE BRACKET PROFILE">SQUARE LINE</option>
              <option value="SLIM LINE CONTINUE PROFILE">SLIM LINE</option>
              <option value="SMALL LINE CONTINUE PROFILE">SMALL LINE</option>
              <option value="STAR LINE BRACKET PROFILE">STAR LINE</option>
              <option value="SKY LINE BRACKET PROFILE">SKY LINE</option>
              <option value="SPARK LINE BRACKET PROFILE">SPARK LINE</option>
              <option value="SLEEK LINE CONTINUE PROFILE">SLEEK LINE</option>
              <option value="SUPER LINE CONTINUE PROFILE">SUPER LINE</option>
              <option value="SIGNATURE LINE CONTINUE PROFILE">SIGNATURE LINE</option>
               <option value="{{ old('productName') }}" @if(old('productName')) selected="selected" @endif >{{ old('productName') }}</option>
            </select>
            @error('productName')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          </td>
          <td>
            <select required type="text" class="form-control @error('productType') is-invalid @enderror" name="productType" id="prtype" onchange="productscover(this.id,'product_cover')">

            </select>
          @error('productType')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          </td>
          <td>
            <select name="productCover" id="product_cover" type="text" class="form-control @error('productCover') is-invalid @enderror" >

            </select>
            <!-- <option value="0">Select product cover</option>
              <option value="SIDE COVER">SIDE COVER</option>
              <option value="FULL/BRACKET WISE">FULL/BRACKET WISE</option> -->
          </td>
          <td>
            <select required name="handrail" type="text" class="form-control @error('handrail') is-invalid @enderror">
              <option value="">Select hand rail</option>
              <option value="ROUND HAND RAIL">ROUND</option>
              <option value="SQUARE HAND RAIL">SQUARE</option>
              <option value="SMALL HAND RAIL">SMALL</option>
              <option value="SLIM HAND RAIL">SLIM</option>
              <option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>
              <option value="HALF ROUND HAND RAIL">HALF ROUND</option>
              <option value="RECTANGLE HAND RAIL">RECTANGLE</option>
              <option value="INCLINE HAND RAIL">INCLINE</option>
               <option value="{{ old('handrail') }}" @if(old('handrail')) selected="selected" @endif >{{ old('handrail') }}</option>
            </select>
            @error('handrail')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          </td>
        </tr>
        <!-- for space -->
        <tr>
          <th colspan="6" width="1500"><center>&emsp;</center></th>
        </tr>

        <tr>
          <td colspan="2">
            <select type="text" class="form-control @error('productColor') is-invalid @enderror" required name="productColor" id="color_type" onchange="colorType(this.id,'colors')">
              <option value="">Select colour</option>
              <option value="ANODISED">ANODISED</option>
              <option value="PVDF">PVDF</option>
              <option value="WOODEN">WOODEN</option>
              <option value="MILL FINISH">MILL FINISH</option>
              <option value="POWDER COATING">POWDER COATING</option>
               <option value="{{ old('productColor') }}" @if(old('productColor')) selected="selected" @endif >{{ old('productColor') }}</option>
            </select>
          @error('productColor')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror </td>

          <td colspan="4">
            <select type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="colors">

            </select>
           @error('color')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          </td>
        </tr>

      </table>
<!-- for space -->
        <tr>
          <th colspan="6" width="1500"><center>&emsp;</center></th>
        </tr>

      <table border="1" >
        <tr>

          <th colspan="6" width="1500"><center>Railing - 1</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="11">
            <select id="inputs1" name="imgrail1" style="color: blue; width: 49%;" onchange="changeimg('imgids','images',this.value)">
              <option value="sline2.png">Straight</option>
              <option value="ctype2.png">C - Type</option>
              <option value="lshape.png">L Shape</option>
              <option value="customized.png">Customized</option>
            </select>

            <!-- Show inputs here -->
            <!-- <fieldset style="width: 20%;">
              <legend>For extra inputs</legend> -->
                <div id="inputs2" style="float: right; width: 20%; color: red;"> </div>

            <!-- </fieldset> -->


            <!-- https://www.techjunkie.com/prevent-google-chrome-storing-browser-history/ -->
              <!-- <div id="inputs2" style="float: right; width: 20%;"></div> -->
              <!-- <div id="input_tb" style="float: center; width: 20%;"></div> -->


             <br><br><br>
            <img style="width: 70%; height: 65%;" src="{{ asset('images/images/sline2.png') }}" id="imgids">
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td width="600" rowspan=""></td>
          <td>Bracket</td>
          <td>Qty</td>
          <td>Accessories</td>
          <td>Qty</td>
        </tr>

        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" id="r1brack75qty" value="" type="number" name="r1brack75qty"></td>
          <td>W/C</td>
          <td style="width: 60px;"><input style="width: 60px;" id="r1acceswcqty" type="number" name="r1acceswcqty"></td>
        </tr>

      <tr>
        <td width="600"></td><td>100</td><td style="width: 60px;"><input type="number" name="r1brack100qty" style="width: 60px;"></td>
        <td>Corner</td>
        <td style="width: 60px;"><input type="number" name="r1accescorqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" name="r1brack150qty" style="width: 60px;"></td><td>Connector</td>
        <td style="width: 60px;"><input type="number" name="r1accesconnqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="r1brackother" style="width: 173px;"></td>
        <td style="width: 60px;"><input type="number" name="r1brackotherqty" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" name="r1accesendcapqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td>Side Cover</td>
        <td>Qty</td>
        <td>Hand Rail</td>
        <td>Qty</td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><select type="text" class="form-control" required name="r1side1">
          <option value="">Select side cover</option>
          <option value="FULL SIDE COVER">FULL SIDE COVER</option>
          <option value="BRACKET WISE">BRACKET WISE</option>
        </select></td>
        <td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="r1side1qty"></td>
        <td style="width: 60px;"><select required class="form-control" style="width: 90px;" type="text" name="r1hr1">
              <option value="">Select hand rail</option>
              <option value="ROUND HAND RAIL">ROUND</option>
              <option value="SQUARE HAND RAIL">SQUARE</option>
              <option value="SMALL HAND RAIL">SMALL</option>
              <option value="SLIM HAND RAIL">SLIM</option>
              <option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>
              <option value="HALF ROUND HAND RAIL">HALF ROUND</option>
              <option value="RECTANGLE HAND RAIL">RECTANGLE</option>
              <option value="INCLINE HAND RAIL">INCLINE</option>
        </select></td><td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="r1hr1qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r1side2"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side2qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr2"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr2qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r1side3"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side3qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr3"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr3qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r1side4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side4qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr4qty"></td>
      </tr>

      <tr>

          <th colspan="6" width="1500"><center>Railing - 2</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="11">
            <select name="imgrail2" style="color: blue; width: 49%;" onchange="changeimg2('imgids','images',this.value)">
              <option value="white.png">Select shape</option>
              <option value="sline2.png">Streight</option>
              <option value="ctype2.png">C - Type</option>
              <option value="lshape.png">L Shape</option>
              <option value="customized.png">Customized</option>
            </select> | <select type="text" style="float: right; width: 49%; color: red;" name="r2glassheight">
            <option value="">Select glass height</option>
          <option>Streight Measurement</option>
          <option>Left Measurement</option>
          <option>Right Measurement</option>
          </select><br><br><br>
            <img style="width: 70%; height: 65%;" src="{{ asset('images/images/white.png') }}" id="imgids2">
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td width="600" rowspan=""></td>
          <td>Bracket</td>
          <td>Qty</td>
          <td>Accessories</td>
          <td>Qty</td>
        </tr>

        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" type="number" name="r2brack75qty"></td>
          <td>W/C</td>
          <td style="width: 60px;"><input style="width: 60px;" type="number" name="r2acceswcqty"></td>
        </tr>

      <tr>
        <td width="600"></td><td>100</td><td style="width: 60px;"><input type="number" name="r2brack100qty" style="width: 60px;"></td>
        <td>Corner</td>
        <td style="width: 60px;"><input type="number" name="r2accescorqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" name="r2brack150qty" style="width: 60px;"></td><td>Connector</td>
        <td style="width: 60px;"><input type="number" name="r2accesconnqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="r2brackother" style="width: 173px;"></td>
        <td style="width: 60px;"><input type="number" name="r2brackotherqty" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" name="r2accesendcapqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td>Side Cover</td>
        <td>Qty</td>
        <td>Hand Rail</td>
        <td>Qty</td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><select type="text" name="r2side1">
          <option value="">Select side cover</option>
          <option value="FULL SIDE COVER">FULL SIDE COVER</option>
          <option value="BRACKET WISE">BRACKET WISE</option>
        </select></td>
        <td style="width: 60px;"><input style="width: 60px;" type="number" name="r2side1qty"></td>
        <td style="width: 60px;"><select style="width: 90px;" type="text" name="r2hr1">
              <option value="">Select hand rail</option>
              <option value="ROUND HAND RAIL">ROUND</option>
              <option value="SQUARE HAND RAIL">SQUARE</option>
              <option value="SMALL HAND RAIL">SMALL</option>
              <option value="SLIM HAND RAIL">SLIM</option>
              <option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>
              <option value="HALF ROUND HAND RAIL">HALF ROUND</option>
              <option value="RECTANGLE HAND RAIL">RECTANGLE</option>
              <option value="INCLINE HAND RAIL">INCLINE</option>
        </select></td><td style="width: 60px;"><input style="width: 60px;" type="number" name="r2hr1qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r2side2"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r2side2qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r2hr2"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r2hr2qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r2side3"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r2side3qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r2hr3"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r2hr3qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r2side4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r2side4qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r2hr4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r2hr4qty"></td>
      </tr>

      <tr>

          <th colspan="6" width="1500"><center>Railing - 3</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="11">
            <select name="imgrail3" style="color: blue; width: 49%;" onchange="changeimg3('imgids3','images',this.value)">
              <option value="white.png">Select shape</option>
              <option value="sline2.png">Streight</option>
              <option value="ctype2.png">C - Type</option>
              <option value="lshape.png">L Shape</option>
              <option value="customized.png">Customized</option>
            </select> | <select type="text" style="float: right; width: 49%; color: red;" name="r3glassheight">
            <option value="">Select glass height</option>
          <option>Streight Measurement</option>
          <option>Left Measurement</option>
          <option>Right Measurement</option>
          </select><br><br><br>
            <img style="width: 70%; height: 65%;" src="{{ asset('images/images/white.png') }}" id="imgids3">
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td width="600" rowspan=""></td>
          <td>Bracket</td>
          <td>Qty</td>
          <td>Accessories</td>
          <td>Qty</td>
        </tr>

        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" type="number" name="r3brack75qty"></td>
          <td>W/C</td>
          <td style="width: 60px;"><input style="width: 60px;" type="number" name="r3acceswcqty"></td>
        </tr>

      <tr>
        <td width="600"></td><td>100</td><td style="width: 60px;"><input type="number" name="r3brack100qty" style="width: 60px;"></td>
        <td>Corner</td>
        <td style="width: 60px;"><input type="number" name="r3accescorqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" name="r3brack150qty" style="width: 60px;"></td><td>Connector</td>
        <td style="width: 60px;"><input type="number" name="r3accesconnqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="r3brackother" style="width: 173px;"></td>
        <td style="width: 60px;"><input type="number" name="r3brackotherqty" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" name="r3accesendcapqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td>Side Cover</td>
        <td>Qty</td>
        <td>Hand Rail</td>
        <td>Qty</td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><select type="text" name="r3side1">
          <option value="">Select side cover</option>
          <option value="FULL SIDE COVER">FULL SIDE COVER</option>
          <option value="BRACKET WISE">BRACKET WISE</option>
        </select></td>
        <td style="width: 60px;"><input style="width: 60px;" type="number" name="r3side1qty"></td>
        <td style="width: 60px;"><select style="width: 90px;" type="text" name="r3hr1">
              <option value="">Select hand rail</option>
              <option value="ROUND HAND RAIL">ROUND</option>
              <option value="SQUARE HAND RAIL">SQUARE</option>
              <option value="SMALL HAND RAIL">SMALL</option>
              <option value="SLIM HAND RAIL">SLIM</option>
              <option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>
              <option value="HALF ROUND HAND RAIL">HALF ROUND</option>
              <option value="RECTANGLE HAND RAIL">RECTANGLE</option>
              <option value="INCLINE HAND RAIL">INCLINE</option>
        </select></td><td style="width: 60px;"><input style="width: 60px;" type="number" name="r3hr1qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r3side2"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r3side2qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r3hr2"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r3hr2qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r3side3"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r3side3qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r3hr3"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r3hr3qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r3side4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r3side4qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r3hr4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r3hr4qty"></td>
      </tr>
    </table>
    <div id="add_railing" >

    </div>
    <br>
    <button style="float: right;" type="button" name="add" class="btn btn-info btn-sm add_"><span class="glyphicon glyphicon-plus"></span>Add More</button><br>
    </div>

  <br>
<center><div class="form-group">
    <input type="submit" class="btn btn-success btn-lg btn-block" value="Submit">
  </div></center>
</div>
</div>
</div>
</form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
