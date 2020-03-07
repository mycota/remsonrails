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
                    </nav></div>

            @include('modals.ApproxRFCalTModal')
            @include('modals.StraightLineModal')
            @include('modals.addMoreProductModal')
            
            <ul class="breadcrumb" style="background-color: ;" >
              <!-- style="position: absolute; margin-left: -400px; margin-top: -35px;" -->
            <a href="{{ route('quotations.edit', $customer->id) }}"><li>Site measurement</li></a> /
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
          <button type="button" name="add" class="btn btn-primary btn-sm showCal"><span class="glyphicon glyphicon-plus"></span>Conversion</button>
        </td>
        <td colspan="2">
        
        </td>

        </tr>
      </table>

      <table border="1" id="addProd">
        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="6" width="1500"><center>Final Product Details</center></th>
        </tr>
        <!-- <tr>
          <th colspan="6" width="1500" style="background-color: #F2F2F2" id="check">

            <button style="float: center;" type="button" name="add" class="btn btn-info btn-sm adProd"><span class="glyphicon glyphicon-plus"></span>Add More Products</button>
          </th>
        </tr> -->
        <tr>
          <td>Product Name</td>
          <td>
            <select required name="productName[]" type="text" class="form-control @error('productName') is-invalid @enderror" id="productName" onchange="products(this.id,'productType'); productscover('productType','productCover')">
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
            <select required type="text" class="form-control @error('productType') is-invalid @enderror" name="productType[]" id="productType" onchange="productscover(this.id,'productCover')">
              <option value="">Product type</option>   
            </select>
          @error('productType')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror  
          </td>
          <td>
            <select name="productCover[]" id="productCover" type="text" class="form-control @error('productCover') is-invalid @enderror" >
              <option value="">Product cover</option>

            </select>
            <!-- <option value="0">Select product cover</option>
              <option value="SIDE COVER">SIDE COVER</option>
              <option value="FULL/BRACKET WISE">FULL/BRACKET WISE</option> -->
          </td>
          <td>
            <select required name="handrail" id="handrail" type="text" class="form-control @error('handrail') is-invalid @enderror">
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
          <td>

            <button style="float: center;" type="button" name="add" class="btn btn-info btn-sm adProd"><span class="glyphicon glyphicon-plus"></span>Add More Products</button>
          </td>
        </tr>
      </table>
        <div >
          
        </div>

        <!-- for space -->
        <table border="1">
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

        <!-- Loop starts here -->

        <tr style="background-color: #e3e3e3; font-size: 16px;">

          <th colspan="6" width="1500"><center>Railing - 1</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="16">
            <!-- <fieldset style=""> -->
            <div style="position: absolute; margin-top: -180px; width: 30%;">
            <select id="rail1" name="imgrail1" style="color: blue; " onchange="changeimg('imgids','images',this.value)" class="form-control">
              <option value="white.png">Select line</option>
              <option value="sline2.png">Straight</option>
              <option value="ctype2.png">C - Type</option>
              <option value="lshape.png">L Shape</option>
              <option value="customized.png">Customized</option>
            </select>
            <!-- <button style="position: absolute; margin-top: -30px; right: -80px;" type="button" name="add" class="btn btn-success btn-sm" id="rail1"><span class="glyphicon glyphicon-plus"></span>Conversion</button> -->
             <br>
            <img src="{{ asset('images/images/white.png') }}" id="imgids" alt="Select line">
          </div>
          <input type="hidden" name="r1" id="r1" value="R1">

          <fieldset  style="width: 50%; background-color: #09586">
            <legend>Summary</legend>

              <div class="content-section" style="background-color: #097586; height: 5px;">
                    
                      <ul class="list-group">
                        <li id="shapetype" class="list-group-item">  </li>
                        <li id="brcktype" class="list-group-item ">  </li>
                        <li class="list-group-item">  </li>
                        <li class="list-group-item">  </li>
                        
                      </ul>
                  </div>
          </fieldset>


          <fieldset  style=" float: right; width: 50%; background-color: #09586">

              <div class="content-section" style="background-color: #097586; height: 5px;">
                    
                      <ul class="list-group">
                        <li id="wc" class="list-group-item ">  </li>
                        <li id="coner" class="list-group-item">  </li>
                        <li id="connt" class="list-group-item">  </li>
                        <li id="encap" class="list-group-item">  </li>
                        
                      </ul>
                  </div>
          </fieldset>


          </td>

          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

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
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack50qty" value="" type="number" name="r1brack50qty"></td>
          <td>W/C</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1acceswcqty" type="number" name="r1acceswcqty"></td>
        </tr>
        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack75qty" value="" type="number" name="r1brack75qty"></td>
          <td>Corner</td>
        <td style="width: 60px;"><input type="number" readonly name="r1accescorqty" id="r1accescorqty" style="width: 60px;"></td>
          
        </tr>

      <tr>
        <td width="600"></td>
        <td>100</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack100qty" id="r1brack100qty" style="width: 60px;"></td>
        <td>Connector</td>
        <td style="width: 60px;"><input type="number" readonly name="r1accesconnqty" id="r1accesconnqty" style="width: 60px;"></td>
        
      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack150qty" id="r1brack150qty" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" readonly name="r1accesendcapqty" id="r1accesendcapqty" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="r1brackother" readonly id="r1brackother" style="width: 173px;"></td>
        <td style="width: 60px;"><input type="number" readonly name="r1brackotherqty" id="r1brackotherqty" style="width: 60px;"></td>
        <td>
          <button style="" type="button" name="add" class="btn btn-danger btn-sm" id="r1clearall"><span class="glyphicon glyphicon-plus"></span>Clear all</button>
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
        <td width="600"></td>
        <td><input readonly type="text" name="r1side4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side4qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr4qty"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r1side4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side4qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr4qty"></td>
      </tr>
      <tr>
        <td width="600"></td>
        <td><input readonly type="text" name="r1side4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side4qty"></td>
        <td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr4"></td>
        <td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr4qty"></td>
      </tr>
      

      <!-- Loop end here -->

      <!-- bring the 2 railing here -->
    </table>
    <div id="add_railings" >
      
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
