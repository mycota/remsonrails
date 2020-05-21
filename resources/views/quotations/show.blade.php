@extends('layouts.app', ['title' => 'Site Measurement',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card">
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav" style="font-size: 16px;">
                        <ul class="nav nav-pills addcolor">
                            <li class="nav-item">
                                <button><a class="nav-link " href="{{ route('quotations.quot_gen.pending_quot') }}">Pending</a></button>
                            </li>

                            <li class="nav-item">
                                <button><a class="nav-link " href="{{ route('quotations.quot_gen.prepared_quot') }}">Prepared</a></button>
                            </li>

                            <li class="nav-item">
                                <button><a class="nav-link " href="{{ route('quotations.quot_gen.prepared_quot') }}">Confirmed</a></button>
                            </li>

                            <li class="nav-item">
                                <button><a class="nav-link " href="{{ route('quotations.quot_gen.prepared_quot') }}">Transported</a></button>
                            </li>

                            <li class="nav-item">
                                <button><a class="nav-link " href="{{ route('quotations.index') }}">All</a></button>
                            </li>

                            @if (Auth::user()->hasAnyRoles(['Admin', 'Sales']))
                                <li class="nav-item">
                                    <button ><a class="nav-link addQuot" href="#">Create Quotation</a></button>
                                </li>
                        @endif

                          <!-- <li class="nav-item">
                            <button data-toggle="modal" data-target="#addTransporterModal"><a class="nav-link " href="#">Pending orders</a></button>
                          </li> -->

                        </ul>
                    </nav>

                  @include('modals.Customized-TypeModal')
            @include('modals.addMoreProductModal')

            @include('modals.ExtraGlassModal')
            @include('modals.ShowExtraGlassModal')
            @include('modals.ClearAllGlassModal')

            <ul class="breadcrumb">
              <!-- style="position: absolute; margin-left: -400px; margin-top: -35px;" -->
            <a href="{{ route('quotations.show', $customer->id) }}"><li>Site measurement</li></a> /
            <li class="active">Site measurement</li>
            </ul>
            <body>
                <div class="card-body cbody">
                  <!-- <br> -->
                    <div id="wrapper">
                        <fieldset class="page-header">
            <!-- <legend>Invoice:</legend> -->
    <!-- <div class="pull-right" style="margin-right:100px;">
      <a href="javascript:Clickheretoprint()" style="font-size:20px; position:absolute; margin-top: -35px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div> -->

    <!-- <a href="{{ route('pdfs.index') }}" style="font-size:20px; position:absolute; margin-top: -35px; left: 900px"><button class="btn btn-info btn-large"><i class="icon-print"></i> PDF format</button></a> -->

  <div class="clearfix"></div></div>
                <!-- </div> -->
<form data-uri="{{ route('quotations.store') }}" method="POST" enctype="multipart/form-data" id="fset0">
<!-- action="{{ route('quotations.store') }}" -->

    @csrf

    <div class="content" id="content">

    <!-- <img style="width: 100%; height: 15%;" src="{{ asset('images/head.jpg') }}"> -->
    <table border="1">

      <tr style="background-color: #008a9f; color: white; font-size: 16px;">
        <th colspan="5" width="1500"><center>Site Measurement Sheet</center></th>

      </tr>

      <tr>
        <td>Party Name</td>
        <td>
          <input type="hidden" value="{{ route('products.create') }}" name="url" id="quoturl">
        <input readonly style="width: 100%;" class="td1" type="text" name="customer_name" value="{{ $customer->customer_name }}" required="" placeholder="Enter party name"></td>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        <input type="hidden" id="quotOrdID" name="quotOrdID" value="{{ $quotOrdID }}">

        <input type="number" hidden name="nofproducts" id="nofproducts" value="1">
        <input type="number" hidden name="nofcolors" id="nofcolors" value="1">
        <input type="number" hidden name="nofrailings" id="nofrailings" value="1">
        <input type="hidden" name="forcusturl" id="forcusturl" data-uri="{{ route('glasstype.update', $quotOrdID) }}">

        <td>Date</td>
        <td colspan="2"><input style="width: 100%;" value="<?php echo date('d-m-Y');?>" type="text" name="date" readonly></td>
      </tr>

      <tr>
        <td>Billing Name</td>
        <td><input readonly style="width: 100%;" class="td1" type="text" value="{{ $customer->customer_name }}" required name="billing_name" placeholder="Enter billing name"></td>
        <td>Place</td>
        <td colspan="2"><input style="width: 100%;" value="{{ $customer->place }} - {{ $customer->countrylist->country }}" type="text" readonly required="" name="place" placeholder="Enter place"></td>
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
            <option value='Toughened'>Toughened</option>
            <option value="Laminated">Laminated</option>
            <option value="Your Scope">Your Scope</option>
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
        <select type="text" class="form-control @error('glasSize1') is-invalid @enderror" name="glasSize1" id="glassize1" onchange="populate2(this.id,'glassize2')">
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
        <td>Size</td>
        <td colspan="2">
        <select type="text" class="form-control"  name="glasSize2" id="glassize2">
        </select>
        </td>
        </tr>

        <tr>
        <td>Approx. RFT </td>
        <td><input id="approxiRFT" required style="width: 100%;" class=" form-control td1 @error('approxiRFT') is-invalid @enderror" type="text" name="approxiRFT" value="{{ old('approxiRFT') }}">
         @error('approxiRFT')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror </td>
        <td>
          <button type="button" class="btn btn-primary btn-sm showCal"><span class="glyphicon glyphicon-plus"></span>Conversion</button>
        </td>
        <td colspan="2">

          <a href="#" style="" class="card-link showmodalextra">Add Extra Glass</a>
          <a href="#" style="color: green;"class="card-link viewextra" data-uri="{{ route('glasstype.show', $quotOrdID) }}">View Store</a>
          <a href="#" style="color: red;" class="card-link clearall" data-uri="{{ route('glasstype.destroy', $quotOrdID) }}">Claer Store</a>
        </td>

        </tr>
      </table>

      <table border="1" id="addProd">
        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="6" width="1500"><center>Final Product Details</center></th>
        </tr>

        <tr>
          <td>Product Name 1.</td>
          <td>
            <select required name="productName[]" type="text" class="form-control @error('productName') is-invalid @enderror" id="productName_R1" onchange="products(this.id,'productType_R1'); productscover('productType_R1','productCover_R1')">
              <option value="">Select product name</option>
              @foreach($products as $product)
              @foreach($product->product_despt()->get()->pluck('description')->toArray() as $despt)
              <?php
                if (strpos($despt, 'Line') !== false) {
                  if (strpos($despt, 'Continue') !== false) {
                    $cont = explode('Continue', $despt);
                    echo "<option value='$despt'>$cont[0]</option>";

                  }elseif (strpos($despt, 'Bracket') !== false) {
                    $brck = explode('Bracket', $despt);
                    echo "<option value='$despt'>$brck[0]</option>";
                  }
                }
              ?>

              @endforeach
              @endforeach
              <!-- <option value="Smart Line Continue Profile">Smart Line</option>
              <option value="Sea Line Bracket Profile">Sea Line</option>
              <option value="Square Line Bracket Profile">Square Line</option>
              <option value="Slim Line Continue Profile">Slim Line</option>
              <option value="Small Line Continue Profile">Small Line</option>
              <option value="Star Line Bracket Profile">Star Line</option>
              <option value="Sky Line Bracket Profile">Sky Line</option>
              <option value="Spark Line Bracket Profile">Spark Line</option>
              <option value="Sleek Line Continue Profile">Sleek Line</option>
              <option value="Super Line Continue Profile">Super Line</option>
              <option value="Signature Line Continue Profile">Signature Line</option>
               <option value="{{ old('productName') }}" @if(old('productName')) selected="selected" @endif >{{ old('productName') }}</option> -->
            </select>
            @error('productName')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          <span id="errorpn1" style="color: red"></span>
          </td>
          <td>
            <select required type="text" class="form-control @error('productType') is-invalid @enderror productType_RN" name="productType[]" id="productType_R1" onchange="productscover(this.id,'productCover_R1')">
              <option value="">Product type</option>
            </select>
          @error('productType')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
          <span id="errorpt1" style="color: red"></span>

          </td>
          <td>
            <select name="productCover[]" id="productCover_R1" type="text" class="form-control @error('productCover') is-invalid @enderror productCover_RN" value="">
              <!-- <option value="">Product cover</option> -->
            </select>
            <span id="errorpc1" style="color: red"></span>

            <!-- <option value="0">Select product cover</option>
              <option value="SIDE COVER">SIDE COVER</option>
              <option value="FULL/BRACKET WISE">FULL/BRACKET WISE</option> -->
          </td>
          <td>
            <!-- <input type="text" name="" value="{{ $products }}"> -->
            <select required name="handRail[]" id="handRail_R1" type="text" class="form-control @error('handRail') is-invalid @enderror handRail_RN">
              <option value="">Select hand rail</option>

              @foreach($products as $product)
              @foreach($product->product_despt()->get()->pluck('description')->toArray() as $despt)
              <?php
                if (strpos($despt, 'Hand Rail') !== false) {
                    echo "<option value='$despt'>$despt</option>";

                }

              ?>

              @endforeach
              @endforeach
              <!-- <option value="Round Hand Rail">Round</option>
              <option value="Square Hand Rail">Square</option>
              <option value="Small Hand Rail">Small</option>
              <option value="Slim Hand Rail">Slim</option>
              <option value="Edge Guard Hand Rail">Edge Guard</option>
              <option value="Half Round Hand Rail">Half Round</option>
              <option value="Rectangle Hand Rail">Rectangle</option>
              <option value="Incline Hand Rail">Incline</option> -->
               <!-- <option value="{{ old('handRail') }}" @if(old('handRail')) selected="selected" @endif >{{ old('handRail') }}</option> -->
            </select>
            @error('handRail')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        <span id="errorhr1" style="color: red"></span>
          </td>
          <td>

            <button style="float: center;" type="button" id="btn_R1" class="btn btn-info btn-sm adProd"><span class="glyphicon glyphicon-plus"></span>Add More Products</button>
          </td>
        </tr>
      </table>


        <!-- for space -->
        <table border="1" id="addProductColor">
        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="8" width="1500"><center>&emsp;</center></th>
        </tr>

        <tr>
          <td>Product Colour 1.</td>
          <td>
            <select type="text" class="form-control @error('productColor') is-invalid @enderror productColor_RN" required name="productColor[]" id="productColor_R1" onchange="colorType(this.id,'color_R1')">
              <option value="">Select colour</option>
              <option value="Anodised">Anodised</option>
              <option value="PVDF">PVDF</option>
              <option value="Wooden">Wooden</option>
              <option value="Mill Finish">Mill Finish</option>
              <option value="Powder Coating">Powder Coating</option>
            </select>
          @error('productColor')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        <span id="errorpco1" style="color: red"></span>
        </td>
        <td colspan="6">
            <div id="selectColor_R1">
            <select type="text" class="form-control @error('color') is-invalid @enderror" name="color[]" id="color_R1">
            </select>
           @error('color')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        <span id="errorpcol1" style="color: red"></span>
      </div>
        <div id="ShowColorInput_R1" >
          <!-- if powerder coating is selected then show an input box to enter -->
        </div>
          </td>


        </tr>
      </table>
<!-- for space -->

      <table border="1">
        <tr>
          <th colspan="6" width="1500"><center>&emsp;</center></th>
        </tr>

        <tr style="background-color: #e3e3e3; font-size: 16px;">
          <span id="notequal"></span>
          <th colspan="6" width="1500"><center>Railing - 1</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="22" style="background-color: white;">
            <div style="position: absolute; margin-top: -150px; width: 30%; height: 10px;">
            <span id="errorshape1" style="color: red"></span>

            <select required id="lineShape_R1" name="shapeName[]" style="color: blue; " onchange="changeimg('imageId_R1','images',this.value)" class="form-control">
              <option value="white.png">Select line</option>
              <option value="sline2.png">Straight</option>
              <option value="ctype2.png">C - Type</option>
              <option value="lshape.png">L Shape</option>
              <option value="customized.png">Customized</option>
            </select>
             <br>
            <img src="{{ asset('images/images/white.png') }}" id="imageId_R1" alt="This file is not image">
          </div>
          <input type="hidden" name="railingNo[]" id="r1" value="1">

          <fieldset  style="width: 100%; background-color:  height: px;">
            <legend>Summary Report</legend>

              <div class="content-section" style="background-color: ; height: 105px;">

                <ul class="list-group" id="bracketsec_R1" style="list-style-type: none; color: #C71585;">
                  <li id="shapetype_R1"> </li>
                  <li id="coner_R1"> </li>
                  <li id="wc_R1"> </li>
                  <li id="connt_R1"> </li>
                  <li id="encap_R1"> </li>
                  <li id="brcktype_R1"> </li>
                  <li id="mg_R1"> </li>
                  <li id="mgl_R1"> </li>
                  <li id="conto_R1"> </li>
                  <li id="glasNo_R1"> </li>
                  <li id="glasNol_R1"> </li>
                  <li id="mgc_R1"> </li>
                  <li id="glasNoc_R1"> </li>
                  <li id="mgr_R1"> </li>
                  <li id="glasNor_R1"> </li>
                  <li id="mgv_R1"> </li>
                  <li id="glasNov_R1"> </li>
                  <li id="mgh_R1"> </li>
                  <li id="glasNoh_R1"> </li>
                </ul>
              <input type="text" hidden readonly name="shapetype_RIN[]" id="shapetype_RIN1" value="">
              <input type="text" hidden readonly name="coner_RIN[]" id="coner_RIN1" value="">
              <input type="text" hidden readonly name="wc_RIN[]" id="wc_RIN1" value="">
              <input type="text" hidden readonly name="connt_RIN[]" id="connt_RIN1" value="">
              <input type="text" hidden readonly name="encap_RIN[]" id="encap_RIN1" value="">
              <input type="text" hidden readonly name="brcktype_RIN[]" id="brcktype_RIN1" value="">
              <input type="text" hidden readonly name="mg_RIN[]" id="mg_RIN1" value="">
              <input type="text" hidden readonly name="mgl_RIN[]" id="mgl_RIN1" value="">
              <input type="text" hidden readonly name="conto_RIN[]" id="conto_RIN1" value="">
              <input type="text" hidden readonly name="glasNo_RIN[]" id="glasNo_RIN1" value="">
              <input type="text" hidden readonly name="glasNol_RIN[]" id="glasNol_RIN1" value="">
              <input type="text" hidden readonly name="mgc_RIN[]" id="mgc_RIN1" value="">
              <input type="text" hidden readonly name="glasNoc_RIN[]" id="glasNoc_RIN1" value="">
              <input type="text" hidden readonly name="mgr_RIN[]" id="mgr_RIN1" value="">
              <input type="text" hidden readonly name="glasNor_RIN[]" id="glasNor_RIN1" value="">
              <input type="text" hidden readonly name="mgv_RIN[]" id="mgv_RIN1" value="">
              <input type="text" hidden readonly name="glasNov_RIN[]" id="glasNov_RIN1" value="">
              <input type="text" hidden readonly name="mgh_RIN[]" id="mgh_RIN1" value="">
              <input type="text" hidden readonly name="glasNoh_RIN[]" id="glasNoh_RIN1" value="">

              </div>
          </fieldset>
          </td>
          <td></td><td></td><td></td><td></td><td></td></tr>

        <tr style="background-color: #191970; color: white; font-size: 16px;">
          <td width="600" rowspan=""></td>
          <td>Bracket</td>
          <td>Qty</td>
          <td>Accessories</td>
          <td>Qty</td>
        </tr>

        <tr>
          <td width="600"></td>
          <td>50</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack50qty_R1" value="" type="number" name="r1brack50qty[]"></td>
          <td>W/C</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1acceswcqty_R1" type="number" name="accesWCQty[]"></td>
        </tr>
        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack75qty_R1" value="" type="number" name="r1brack75qty[]"></td>
          <td>Corner</td>
        <td style="width: 60px;"><input type="number" readonly name="accesCornerQty[]" id="r1accescorqty_R1" style="width: 60px;"></td>

        </tr>

      <tr>
        <td width="600"></td>
        <td>100</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack100qty[]" id="r1brack100qty_R1" style="width: 60px;"></td>
        <td>Connector</td>
        <td style="width: 60px;"><input type="number" readonly name="accesConnectorQty[]" id="r1accesconnqty_R1" style="width: 60px;"></td>

      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack150qty[]" id="r1brack150qty_R1" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" readonly name="accesEndcapQty[]" id="r1accesendcapqty_R1" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="bracketFP[]" value="" readonly id="r1brackother_R1" style="width: 150px; text-align: left;"></td>
        <td style="width: 60px;"><input type="number" readonly name="bracketFPQty[]" id="r1brackotherqty_R1" style="width: 60px;"></td>
        <td>
          <button style="" type="button" class="btn btn-danger btn-sm" id="r1clearall_R1"><span class="glyphicon glyphicon-plus"></span>Clear all</button>
        </td>
        <td></td>
      </tr>

      <tr style="background-color: #F8F8FF;">
        <td width="600"></td>
        <td>Side Cover</td>
        <td>Qty</td>
        <td>Hand Rail</td>
        <td>Qty</td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input style="width: 150px;" readonly type="text"  class="" name="sideCover[]" id="brackSideCover1_R1" value="">

        </td>
        <td style="width: 60px;"><input style="width: 60px;" class="" type="number" name="sideCoverQty[]" readonly id="brackSideCover1Qty_R1"></td>
        <td style="width: 60px;">
        <input readonly id="accesHandRail1_R1" required class="" style="width: 90px;" type="text" name="acceshandRail[]">
        </td>
        <td style="width: 60px;"><input style="width: 60px;" class="" type="number" name="acceshandRailQty[]" readonly id="accesHandRail1Qty_R1"></td>
      </tr>

      <?php
        $tr = 0;
        while ( $tr <= 10) {
          echo '<tr>';
          echo '<td width="600"></td>';
          echo '<td><label></label></td>';
          echo '<td style="width: 60px;"><label></label></td>';
          echo '<td style="width: 60px;"><label></label></td>';
          echo '<td style="width: 60px;"><label></label></td>';
          echo '</tr>';
          $tr++;
        }?>

    </table>
    <div id="addRailings" >

    </div>
    <br>
          <!-- <button style="float: right;" type="button" name="add" class="btn btn-info btn-sm add"><span class="glyphicon glyphicon-plus"></span>Add More</button><br>
          </div> -->

  <center><div class="form-group" style="margin: 0px;">
    <input type="submit" class="btn btn-success btn-lg btn-block" id="saveQuotation"  value="Submit">
  </div></center>
</form>
</fieldset>
</div>
</div>
</body>
</div>
</div>
</div>
</div>
</div>
@endsection
