@extends('layouts.navbar', ['title' => 'Site Measurement',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


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
            @include('modals.StraightLineModal')
            @include('modals.C-TypeModal')
            @include('modals.L-TypeModal')
            @include('modals.Customized-TypeModal')
            @include('modals.addMoreProductModal')
            
            <ul class="breadcrumb" style="background-color: ;" >
              <!-- style="position: absolute; margin-left: -400px; margin-top: -35px;" -->
            <a href="{{ route('quotations.edit', $customer->id) }}"><li>Site measurement</li></a> /
            <li class="active">Site measurement</li>
            </ul>
            <body>
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

      <tr style="background-color: #008a9f; color: white; font-size: 16px;">
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
        <td>Size</td>
        <td colspan="2">
        <select type="text" class="form-control"  name="glasSize2" id="glassize2">
        </select>
        </td>
        </tr>

        <tr>
        <td>Approx. RFT </td>
        <td><input id="approxiRFT" style="width: 100%;" class=" form-control td1 @error('approxiRFT') is-invalid @enderror" type="text" name="approxiRFT" value="{{ old('approxiRFT') }}">
         @error('approxiRFT')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror </td>
        <td>
          <button type="button" class="btn btn-primary btn-sm showCal"><span class="glyphicon glyphicon-plus"></span>Conversion</button>
        </td>
        <td colspan="2">
        
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
            <select required type="text" class="form-control @error('productType') is-invalid @enderror" name="productType[]" id="productType_R1" onchange="productscover(this.id,'productCover_R1')">
              <option value="">Product type</option>   
            </select>
          @error('productType')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror  
          </td>
          <td>
            <select name="productCover[]" id="productCover_R1" type="text" class="form-control @error('productCover') is-invalid @enderror" >
              <option value="">Product cover</option>

            </select>
            <!-- <option value="0">Select product cover</option>
              <option value="SIDE COVER">SIDE COVER</option>
              <option value="FULL/BRACKET WISE">FULL/BRACKET WISE</option> -->
          </td>
          <td>
            <select required name="handRail[]" id="handRail_R1" type="text" class="form-control @error('handRail') is-invalid @enderror">
              <option value="">Select hand rail</option>
              <option value="ROUND HAND RAIL">ROUND</option>
              <option value="SQUARE HAND RAIL">SQUARE</option>
              <option value="SMALL HAND RAIL">SMALL</option>
              <option value="SLIM HAND RAIL">SLIM</option>
              <option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>
              <option value="HALF ROUND HAND RAIL">HALF ROUND</option>
              <option value="RECTANGLE HAND RAIL">RECTANGLE</option>
              <option value="INCLINE HAND RAIL">INCLINE</option>
               <option value="{{ old('handRail') }}" @if(old('handRail')) selected="selected" @endif >{{ old('handRail') }}</option>
            </select>
            @error('handRail')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror 
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
            <select type="text" class="form-control @error('productColor') is-invalid @enderror" required name="productColor[]" id="productColor_R1" onchange="colorType(this.id,'color_R1')">
              <option value="">Select colour</option>
              <option value="ANODISED">ANODISED</option>
              <option value="PVDF">PVDF</option>
              <option value="WOODEN">WOODEN</option>
              <option value="MILL FINISH">MILL FINISH</option>
              <option value="POWDER COATING">POWDER COATING</option>
            </select>
          @error('productColor')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror 
          </td>
          <td colspan="6">
            <div id="selectColor_R1">
            <select type="text" class="form-control @error('color') is-invalid @enderror" name="color[]" id="color_R1">
              
            </select>
           @error('color')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror</div>
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

          <th colspan="6" width="1500"><center>Railing - 1</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="22">
            <div style="position: absolute; margin-top: -220px; width: 30%;">
            <select id="lineShape_R1" name="lineShape[]" style="color: blue; " onchange="changeimg('imageId_R1','images',this.value)" class="form-control">
              <option value="white.png">Select line</option>
              <option value="sline2.png">Straight</option>
              <option value="ctype2.png">C - Type</option>
              <option value="lshape.png">L Shape</option>
              <option value="customized.png">Customized</option>
            </select>
             <br>
            <img src="{{ asset('images/images/white.png') }}" id="imageId_R1" alt="This file is not image">
          </div>
          <input type="hidden" name="r1" id="r1" value="1">

          <fieldset  style="width: 100%; background-color:  height: 5px;">
            <legend>Summary</legend>

              <div class="content-section" style="background-color: ; height: 5px;">
                    
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
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1acceswcqty_R1" type="number" name="r1acceswcqty[]"></td>
        </tr>
        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack75qty_R1" value="" type="number" name="r1brack75qty[]"></td>
          <td>Corner</td>
        <td style="width: 60px;"><input type="number" readonly name="r1accescorqty[]" id="r1accescorqty_R1" style="width: 60px;"></td>
          
        </tr>

      <tr>
        <td width="600"></td>
        <td>100</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack100qty[]" id="r1brack100qty_R1" style="width: 60px;"></td>
        <td>Connector</td>
        <td style="width: 60px;"><input type="number" readonly name="r1accesconnqty[]" id="r1accesconnqty_R1" style="width: 60px;"></td>
        
      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack150qty[]" id="r1brack150qty_R1" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" readonly name="r1accesendcapqty[]" id="r1accesendcapqty_R1" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="r1brackother[]" readonly id="r1brackother_R1" style="width: 173px; text-align: right;"></td>
        <td style="width: 60px;"><input type="number" readonly name="r1brackotherqty[]" id="r1brackotherqty_R1" style="width: 60px;"></td>
        <td>
          <button style="" type="button" class="btn btn-danger btn-sm" id="r1clearall_R1"><span class="glyphicon glyphicon-plus"></span>Clear all</button>
        </td>
        <td></td>
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
        <td><select type="text" class="form-control" required name="brackSideCover1[]" id="brackSideCover1_R1">
          
        </select></td>
        <td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="brackSideCover1Qty[]" id="brackSideCover1Qty_R1"></td>
        <td style="width: 60px;">
        <select id="accesHandRail1_R1" required class="form-control" style="width: 90px;" type="text" name="accesHandRail1[]">
              
        </select></td><td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="accesHandRail1Qty" id="accesHandRail1Qty_R1"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
        <td style="width: 60px;"><label></label></td>
      </tr>
    </table>
    <div id="addRailings" >
      
    </div>
    <br>
          <!-- <button style="float: right;" type="button" name="add" class="btn btn-info btn-sm add"><span class="glyphicon glyphicon-plus"></span>Add More</button><br>
          </div> -->

  <center><div class="form-group">
    <input type="submit" class="btn btn-success btn-lg btn-block" value="Submit">
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
