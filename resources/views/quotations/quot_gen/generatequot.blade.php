@extends('layouts.navbar', ['title' => 'Site Measurement',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
          <br><br>
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

                          <!-- <li class="nav-item">
                            <button data-toggle="modal" data-target="#addTransporterModal"><a class="nav-link " href="#">Pending orders</a></button>
                          </li> -->
                           
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
    <a href="{{ route('pdfs.index') }}" style="font-size:20px; position:absolute; margin-top: -40px; left: 900px"><button class="btn btn-info btn-large"><i class="icon-print"></i> Download</button></a>

  
  <div class="clearfix"></div></div>
                <!-- </div> -->
<form data-uri="{{ route('quotations.store') }}" method="POST" enctype="multipart/form-data" id="fset0">    
    @csrf
      
    <div class="content" id="content">

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
        {{ $quot->custquot->refby }}
        </td>
        
        </tr>

        <tr>
        <td>Place.</td>
        <td class="bkg"> {{ $quot->custquot->place }}</td>
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
        <th colspan="2"><center> Rate / Rft.</center></th>
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
    echo "<td colspan='2' class='bkg'> <input type='text' name='amountper[]' id='amt".$prodNo[$i]."' value='' class='form-control'></td>";
      echo "</tr>";
    }
      ?>
      <tr>
        <th colspan="5" width="1500">&emsp;</th>
      </tr>
      <tr>
        <td class="bkg" rowspan="5"></td> 
        <td class="bkg" rowspan="2" class="bkg">
        Hilti Anchor Fastener For Bottom Bracket<br/>
        Epdm Gasket As Per Glass Size<br/>
        End Cap / Wall Concealed</td>
        <td><center>Installation</center></td> 
        <td rowspan="2" class="bkg">Put your or our scope here</td>
      </tr>
      <tr>
        <td class="bkg"><center>{{ implode(', ', $quot->order_glass_types()->get()->pluck('glasstype')->toArray()) }}</center></td>
        
        
      </tr>

      <tr>
        <td class="bkg" ><center><span style="float: left;">Glass Height</span> | <span style="float: right;">Value here</span></center></td>
        <td>GST 18%</td>
        <td class="bkg"> 
          <select id="gst18" type="text" class="form-control" name="gst18" required>
          <option value="Extra">Extra</option>
          <option value="Included">Included</option>
          </select>
      </td>
      </tr>

      <tr>
        <td class="bkg"><center>Aluminium Profile {{ implode(', ', $quot->order_product_colors()->get()->pluck('productColor')->toArray()) }}</center></td>
        <td>Transportation & Packing</td>
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
      </ul>
    </div>
  </fieldset>
</div>
<div class="col-md-6">
      <fieldset class="form-group" style="width: 100%; background-color: #">
        <center><legend class="border-bottom mb-4" style="float: left; position: relative;">Payment Terms:</legend></center>
        <div class="content-section" style="background-color: ; font-size: 16px;">
          <ul class="" style="float: left; display: ; list-style-type: none; list-style-position: inside;">
          <li class="">
            <label class="radio-inline">
              <input type="checkbox" name="payterms[]" value="50% Advance On Order Confirmation">&emsp;50% Advance On Order Confirmation
            </label>
          </li>
          <li class="">
            <label class="radio-inline">
              <input type="checkbox" name="payterms[]" value="50% On Material Dispatch">&emsp;50% On Material Dispatch
            </label>
          </li>
          <li class="">
            <label class="radio-inline">
              <input type="checkbox" name="payterms[]" value="25% Advance On Order Confirmation">&emsp;25% Advance On Order Confirmation
            </label>
          </li>
          <li class="">
            <label class="radio-inline">
              <input type="checkbox" name="payterms[]" value="25% On Material Dispatch">&emsp;25% On Material Dispatch
            </label>
          </li>
          <li class="">
            <label class="radio-inline">
              <input type="checkbox" name="payterms[]" value="40% On Glass Being Order">&emsp;40% On Glass Being Order
            </label>
          </li>
          <li class="getmore">
            <label class="radio-inline">
              <input type="checkbox" name="payterms[]" value="10% On Installation">&emsp;10% On Installation
            </label>
          </li>

          <span style="color: #6495ED">Add More Payment Terms (Press Enter)</span><br>
          <input type='text' name='' id='term' value='' class='form-control'>

      </ul>
    </div>
  </fieldset>
</div>
</div>
</div>
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
