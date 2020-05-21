@extends('layouts.app', ['title' => 'Generate Quotation',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')

<style type="text/css">
        .btn-primar {
            background: #00008B;
            background-image: -webkit-linear-gradient(top, #eb94d0, #2079b0);  background-image: -moz-linear-gradient(top, #eb94d0, #2079b0);  background-image: -ms-linear-gradient(top, #eb94d0, #2079b0);  background-image: -o-linear-gradient(top, #eb94d0, #2079b0);  background-image: linear-gradient(to bottom, #eb94d0, #2079b0);
            -webkit-border-radius: 28;  -moz-border-radius: 28;  border-radius: 28px;
            text-shadow: 3px 2px 1px blue;  -webkit-box-shadow: 6px 5px 24px #666666;  -moz-box-shadow: 6px 5px 24px #666666;  box-shadow: 6px 5px 24px #666666;
            font-family: Arial;  color: #fafafa;  font-size: 15px;  padding: 19px;  text-decoration: none;}
        .btn-primar:hover {
          background: #2079b0;
          background-image: -webkit-linear-gradient(top, #2079b0, #eb94d0);  background-image: -moz-linear-gradient(top, #2079b0, #eb94d0);  background-image: -ms-linear-gradient(top, #2079b0, #eb94d0);  background-image: -o-linear-gradient(top, #2079b0, #eb94d0);  background-image: linear-gradient(to bottom, #2079b0, #eb94d0);
          text-decoration: none;
        }

    /*Image style*/
    div.gallery {
      margin: 2px;
      border: 1px solid #ccc;
      float: left;
      width: 130px;
    }

    div.gallery:hover {
      border: 1px solid #777;
    }

    div.gallery img {
      width: 100%;
      height: auto;
    }



    </style>
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
                    <style type="text/css">

                      .bkg{background-color: white;}
                    </style>

                    <!-- Modal was here -->

            <ul class="breadcrumb" style="background-color: ;" >
              <!-- style="position: absolute; margin-left: -400px; margin-top: -35px;" -->
            <a href="{{ route('quotations.quot_gen.generatequot', $quot->id) }}"><li>Generate Quotation</li></a> /
            <li class="active">Generate Quotation</li>
            </ul>
            <body>
                <div class="card-body" style="border: 1px solid #006400; ">
                  <br>

    <div id="wrapper">
    <!-- <a href="{{ route('quotations.quot_gen.finalquotationpdf', 3) }}" style="font-size:20px; position:absolute; margin-top: -40px; left: 900px"><button class="btn btn-info btn-large"><i class="icon-print"></i> Download</button></a> -->


  <div class="clearfix"></div></div>
                <!-- </div> -->
<form data-uri="{{ route('quotations.quot_gen.finalquotation') }}" method="POST" enctype="multipart/form-data" id="generate">
    @csrf

    <input type="number" hidden name="noOfRailing" value="{{ $quot->noOfRailing }}">
    <input type="text" hidden name="quotID" value="{{ $quot->quotOrdID }}">
    <input type="text" hidden name="orderID" id="orderID" value="{{ $quot->id }}">


    <div class="content" id="content" style="background-color: white;">

    <img style="width: 100%; height: 15%;" src="{{ asset('images/head.jpg') }}">
    <center><h2>Quotation</h2></center>
    <table border="1">

      <tr>
        <th colspan="5" width="1500">&emsp;</th>

      </tr>
      <tr>
        <td>Party Name.</td>
        <td class="bkg">
        {{ $quot->custquot->customer_name }}</td>
        <td>Date</td>
        <td colspan="2" class="bkg">{{ date('d-m-Y',strtotime($quot->created_at)) }}</td>
      </tr>
      <tr>
        <td>Site Address.</td>
        <td rowspan="3" class="bkg">
          <p>{{ $quot->custquot->address }}</p>
        </td>
        <td>Proposal No.</td>
        <td colspan="2" class="bkg">{{ $quot->quotOrdID }}</td>
      </tr>

      <tr>
        <td>
          <!-- {{ $quot->custquot->place }} -->
        </td>
        <td>Architect.</td>
        <td colspan="2" class="bkg">
        </td>
      </tr>

      <tr>
        <td></td>
        <td>Reference By.</td>
        <td class="bkg">
        {{ $quot->refby }}
        </td>

        </tr>

        <tr>
        <td>Place.</td>
        <td class="bkg"> {{ $quot->custquot->place }} - {{ $quot->custquot->countrylist->country }}</td>
        <td>Product Code.</td>
        <input type="hidden" name="" id="getd" value="{{ implode(', ', $quot->order_product_details()->get()->pluck('productName')->toArray()) }}">
        <td colspan="2" class="bkg" id="prod_details">
        </td>
        </tr>
        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="6" width="1500" class="bkg"><center>Aluminium Glass Railing System</center></th>
        </tr><tr>
        <th><center> Sr No.</center></th>
        <th><center> Railing Type</center></th>
        <th><center> Product Details </center></th>
        <th colspan="2"><center id="rate"> Rate / Rft.</center></th>
      </tr>

      <?php

        $prodName = array();
        $prodNo = array();
        $prodCov = array();
        $prodRai = array();

        $brcktype = array();

        foreach ($quot->order_product_details as $prod) {
           $prodName[] = $prod->productName;
           $prodNo[] = $prod->railingNo;
           $prodCov[] = $prod->productCover;
           $prodRai[] = $prod->handRail;
           // array_push($prodName, $prod->productName);

         }

         foreach ($quot->order_railing_reports as $report) {
           $brcktype[] = $report->brcktype_RIN;

         }

         // print_r($prodRai);

      for($i=0; $i < count($prodNo); $i++){


        echo "<tr>";
        echo "<td class='bkg'><center> $prodNo[$i] </center></td>";
        echo "<td class='bkg'>";


        for($j=$i; $j <= $i; $j++){

          if (strpos($prodName[$j], 'Continue') !== false) {
              $cont = explode('Continue', $prodName[$j]);
              $brktyp = explode(' | ', $brcktype[$j]);

              echo $cont[0].' '.$brktyp[0]."<br/>";

          }else{
              $brk = explode('Bracket', $prodName[$j]);
              $brktyp = explode(' | ', $brcktype[$j]);

              echo $brk[0].' '.$brktyp[0]."<br/>";

              }
          if ($prodCov[$j]) {
              echo $prodCov[$j].'<br/>';
          }

          echo $prodRai[$j];

        }
        echo "</td>";


        echo "<td class='bkg'>";

        for($k=$i; $k<=$i; $k++){
         // Spliting based on some values to
        if (strpos($prodName[$k], 'Continue') !== false) {
              $cont1 = explode('Continue', $prodName[$k]);

              echo $cont1[0];

          }else{
              $brk1 = explode('Bracket', $prodName[$k]);

              echo $brk1[0];

              }
          if ($prodCov[$k]) {
              echo 'with '.$prodCov[$k];
          }

          echo '<br/>'.'along with '.$prodRai[$k];

          echo "</td>";
    }
    echo "<td colspan='2' class='bkg'> <input type='text' name='amountper[]' id='amt".$prodNo[$i]."' value='' class='form-control getvalue'></td>";
      echo "</tr>";
    }
      ?>
      <tr>
        <th colspan="5" width="1500">&emsp;</th>
      </tr>
      <?php

         $glassType = array();
         $glassScope = array();

         foreach($quot->order_glass_types as $gtype){

                if ($gtype->glasstype != 'Your Scope') {
                  array_push($glassType, $gtype->glasstype);
                }
                if ($gtype->glasstype === 'Your Scope') {
                  array_push($glassScope, $gtype->glasstype);
                }
         }
         ?>
      <tr>
        <td class="bkg" rowspan="5"></td>
        <td class="bkg" rowspan="1" class="bkg">
        Hilti Anchor Fastener For Bottom Bracket<br/>
        Epdm Gasket As Per Glass Size<br/>
        End Cap / Wall Concealed</td>
        <td><center>Installation</center></td>
        <td rowspan="2" class="bkg">
        <center> <?php echo implode(', ',$glassScope); ?></center>
        </td>
      </tr>
      <tr>
        <td class="bkg"><center><span style="float: left;">Approx. Rft:
        </span> | <span style="float: ;">&emsp;&emsp;&emsp;{{ $quot->approxiRFT }}</span></center></td>
        <td class="bkg"><center>
        <?php echo implode(', ',$glassType); ?>

        </center></td>
        <!-- <td>
          <select id="gst18" type="text" class="form-control" name="gst18" required>
          <option value="Your scope">Your scope</option>
          <option value="Our scope">Our scope</option>
          </select>
        </td>  -->
      </tr>

      <tr>
        <td class="bkg" ><center><span style="float: left;"><select id="" type="text" class="" name="glassheight" required>
          <option value="Glass Height">Glass Height</option>
          <option value="Total Railing Height">Total Railing Height</option>
          </select>

          <select id="" type="text" class="" name="glassunit" required>
          <option value="MM">MM</option>
          <option value="RFT">RFT</option>
          </select>
        </span> | <span style="float: right;"><input type='text' required name='glasshihtvalue' id='glasshihtvalue' value='' class=''></span></center></td>
        <td><center>GST 18%</center></td>
        <td class="bkg">
          <select id="gst18" type="text" class="form-control" name="gst18" required>
          <option value="Extra">Extra</option>
          <option value="Included">Included</option>
          </select>
      </td>
      </tr>

      <tr>
        <td class="bkg"><center>Aluminium Profile {{ implode(', ', $quot->order_product_colors()->get()->pluck('productColor')->toArray()) }}</center></td>
        <td><center> Transportation & Packing</center></td>
        <td class="bkg">
          <select id="transport" type="text" class="form-control" name="transport" required>
          <option value="Extra">Extra</option>
          <option value="Included">Included</option>
          </select>
        </td>

        </tr>

    </table><br/>

    <div class="col-md-12">
      <div class="row" style="background-color: white;">
        <div class="col-md-6">
          <fieldset class="form-group" style="width: 100%; background-color: #">
              <center><legend class="border-bottom mb-4">Terms & Condition:</legend></center>
          <div class="content-section" style="background-color: ; font-size: 18px;">
          <ul class="" style="float: right; list-style-type: square;">
          <li class="">Validity : Quotation Valid For 30 Days Only.</li>
          <li class="">Delivery : 30 Days From Date Of Order Confirmation.</li>
          <li class="" id="finish">Finish: Aluminium Profile {{ implode(', ', $quot->order_product_colors()->get()->pluck('productColor')->toArray()) }}.</li>
          <li class="" id="tax"></li>
          <li class="">Once Order Confirmed Can Not Be Cancelled.</li>
          <li class="">Company Shall Not Be Liable For Any Breakage
Of Flooring While Installation.</li>
  <br>
<div style="float: left;">
      <span style="text-decoration-line: underline; font-size: 25px;">Prepared By.</span><br>
      <span>Remson Rail Systems Inc</span><br>
      <span>Rajan Vachhani</span><br><br>
      <img width="100" src="{{ asset('images/stamp_final.PNG') }}">
    </div>
      </ul>

    </div>
  </fieldset>
</div>
<div class="col-md-6">
      <fieldset class="form-group" style="width: 100%; background-color: #">
        <center><legend class="border-bottom mb-4" style="float: left; position: relative;">Payment Terms:</legend></center>
        <div class="content-section" style="background-color: ; font-size: 16px;">
          <ul class="" style="float: left; display: ; list-style-type: none; list-style-position: inside;">

          <li class="getmore forval">
            <label class="radio-inline">
              <input type="hidden" name="" value=""></label>
          </li>


          <span style="color: #6495ED" >Add More Payment Terms (Select to Add)</span><br>
          <select id="fromDB" type="text" class="form-control">
          <option value="">Add more from the system</option>
          @foreach($payterms as $payterm)
            <option value="{{ $payterm->name }}">{{ $payterm->name }}</option>
          @endforeach
          </select><br>
          <span id="erDB" class="alert-danger"></span>

          <span style="color: navy" >Create New Payment Term (Type and Press Enter)</span><br>
          <input type='text' name='' id='term' value='' class='form-control'>
          <span id="er" class="alert-danger"></span><br>

          <span style="color: #BDB76B" id="currency"></span><br>
          <input type="number" hidden name="currencyid" id="currencyid">
          <select id="currDB" type="text" name="paycurrency" class="form-control">
          <option selected="" value="79 | Rupee | INR | ₹">India | Indian | Rupee | INR | ₹</option>
          @foreach($countries as $country)
            <option value="{{ $country->id }} | {{ $country->currency }} | {{ $country->code }} | {{ $country->symbol }}">{{ $country->country }} | {{ $country->currency }} | {{ $country->code }} | {{ $country->symbol }}</option>
          @endforeach
          </select><br>

      </ul>
      <!-- <input type="text" hidden name="" id="pimage" value="{{ implode(', ', $product_images) }}">
      <input type="text" hidden name="" id="himage" value="{{ implode(', ', $hand_rail_images) }}">

      <div class="images_" style="">

    </div> Not needed -->
    </div>

  </fieldset>

 <?php
       for($i = 0; $i < count($product_images); $i++){

            echo "<div class='gallery'>";
            echo "<img width='100' src='http://localhost/remsonrails/public/images/product_images/".$product_images[$i]."'>";
            echo "</div>";

            if ($i === 1) {
              echo "<br/> <br/> <br/> <br/> <br/> <br/><br/> <br/> <br/> <br/> <br/> <br/>";
            }

            for($j = $i; $j<= $i; $j++){

              echo "<div class='gallery'>";
              echo "<img width='100' src='http://localhost/remsonrails/public/images/product_images/".$hand_rail_images[$j]."'>";
              echo "</div>";
            }
       }
   ?>
</div>
</div>
</div><br>
<center><img style="width: 40%; height: 10%;" src="{{ asset('images/leter_paddfbg.jpg') }}"></center>

</div>

<br>
<span id="rate_error"></span>

<center><div><button type="submit" class="btn-primar" id="" >Generate Final Quotation</button></div></center>
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
