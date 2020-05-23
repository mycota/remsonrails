<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>{{ $quot->quotOrdID }} {{ $quot->custquot->customer_name }} </title>

            <link href="http://localhost/remsonrails/public/css/all.min.css" rel="stylesheet">
            <link href="http://localhost/remsonrails/public/css/invoice.css" rel="stylesheet">

            <link rel="icon" type="image/jpg" scr="http://localhost/remsonrails/public/images/Rem_Icon.png">

            <!-- <link href="http://localhost/remsonrails/public/css/bootstrap_mpdf.css"> -->

    <style type="text/css">
    /*Image style*/
    div.gallery {
      margin: 2px;
      border: 1px solid #ccc;
      float: left;
      width: 100px;
    }

    div.gallery:hover {
      border: 1px solid #777;
    }

    div.gallery img {
      width: 100%;
      height: auto;
    }

    .bkg{background-color: white;}

    .row {
        margin: 10px 0px 0px 0px !important;
        padding: 0px !important;
    }

    .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    border:0;
    padding:0;
    margin-left:-0.00001;
    }
  </style>

        </head>
        <body>
            <div class="container-fluid invoice-container">

                    <div class="row invoice-header">
                        <div class="invoice-col">
                        <img style="width: 100%; height: 15%;" src="http://localhost/remsonrails/public/images/head.jpg">

                        </div>
                        <div class="invoice-col text-center">

            <div class="invoice-status">
            <span class="paid">Quotation</span>

            </div>
                            <small>({{ $quot->orderStatus }})</small>


                        </div>
                    </div>

                    <hr>


                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <h3 class="panel-title"><strong>Invoice Items</strong></h3>
                        </div> -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-condensed table-bordered" border="1" style="font-size: 30px;">

    <tr>
    <th colspan="5" width="1500" style="background-color: #097586">&emsp;</th>

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
        <td colspan="2" class="bkg">
        {{ $quot->refby }}
        </td>
        </tr>

        <tr>
        <td>Place.</td>
        <td class="bkg"> {{ $quot->custquot->place }} - {{ $quot->custquot->countrylist->country }}</td>
        <td>Product Code.</td>
        <input type="hidden" name="" id="getd" value="{{ implode(', ', $quot->order_product_details()->get()->pluck('productName')->toArray()) }}">
        <?php

        $prod_name = array();

        foreach ($quot->order_product_details as $prod) {

                  $getProd = explode(' ', $prod->productName);
                  $prod_name[] = $getProd[0].' '.$getProd[1];

          }

        ?>
        <td colspan="2" class="bkg" id="prod_details">
            <?php echo implode('/ ',$prod_name); ?>
        </td>
        </tr>

        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="6" width="1500" class="bkg"><center>Aluminium Glass Railing System</center></th>
        </tr>

        <tr>
        <th><center> Sr No.</center></th>
        <th><center> Railing Type</center></th>
        <th><center> Product Details </center></th>
        <th colspan="2"><center> Rate / Rft. ( {{ $final_quot->payment_currency }} ) </center></th>
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
    echo "<td colspan='2' class='bkg'> <center>".$rftvalues[$i]."/-</center></td>";
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

      </tr>

      <tr>
        <td class="bkg" ><center><span style="float: left;">{{ $final_quot->glassHeight }}

          {{ $final_quot->glassUnit }}
        </span> | <span style="float: right;">
          {{ $final_quot->values }}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span></center></td>
        <td> <center>GST 18%</center></td>
        <td class="bkg">  <center>
          {{ $final_quot->gst }}
      </center></td>
      </tr>

      <tr>
        <td class="bkg"><center>Aluminium Profile {{ implode(', ', $quot->order_product_colors()->get()->pluck('productColor')->toArray()) }}</center></td>
        <td> <center>Transportation & Packing</center></td>
        <td class="bkg"> <center>
          {{ $final_quot->transport }}
        </center></td>

        </tr>
    </table>
    <br/>
      <div class="" style="background-color: white;">
        <div class="col-md-4">
          <fieldset style="width: ; background-color: white;">
              <center><legend class="border-bottom mb-4"><h3 style="font-size: 20px; text-decoration: underline; font-weight:bold">Terms & Condition:</h3></legend></center>
          <div class="content-section" style="">
          <ul class="" style="float: right; list-style-type: square; list-style-position: inside; font-size: 16px;">
          <li class="">Validity : Quotation Valid For 30 Days Only.</li>
          <li class="">Delivery : 30 Days From Date Of Order Confirmation.</li>
          <li class="" id="finish">Finish: Aluminium Profile {{ implode(', ', $quot->order_product_colors()->get()->pluck('productColor')->toArray()) }}.</li>
          <li class="">Taxes : All Government Taxes As Applicable. ( {{ $final_quot->gst }} )</li>
          <li class="">Once Order Confirmed Can Not Be Cancelled.</li>
          <li class="">Company Shall Not Be Liable For Any Breakage
            Of Flooring While Installation.</li>

      </ul>
    <h3 style="text-decoration: underline; font-size: 20px; font-weight:bold;">Payment Terms</h3>
          <ul class="" style="float: left; list-style-type: circle; list-style-position: inside; font-size: 16px;">

            @foreach($paymentTerms as $paymentTerm)
              <li class="forval"><label class="radio-inline"><input disabled="" type="checkbox" checked="" value="">&emsp; {{ $paymentTerm }}</label> </li>
            @endforeach

      </ul>

        <div style="float: left;">
            <span style="text-decoration: underline; font-size: 20px; font-weight:bold; font-size: 20px;">Prepared By.</span><br>
              <span>Remson Rail Systems Inc</span><br>
              <span>Rajan Vachhani</span><br><br>
              <img width="100" src="http://localhost/remsonrails/public/images/stamp_final.PNG">
        </div>
        <br>
 <?php
       for($i = 0; $i < count($product_images); $i++){

            echo "<div class='gallery'>";
            echo "<img width='100' src='http://localhost/remsonrails/public/images/product_images/".$product_images[$i]."'>";
            echo "</div>";

            for($j = $i; $j<= $i; $j++){

              echo "<div class='gallery'>";
              echo "<img width='100' src='http://localhost/remsonrails/public/images/product_images/".$hand_rail_images[$j]."'>";
              echo "</div>";
            }
       }
   ?>
</div>
  </fieldset>
</div>
<br>
</div>
</div>
 <div class="invoice-col text-center"><img style="width: 50%; right: 800px;" src="http://localhost/remsonrails/public/images/leter_paddfbg.jpg"></div>

        </body>
        </html>'
