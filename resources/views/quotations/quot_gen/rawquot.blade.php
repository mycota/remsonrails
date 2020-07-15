@extends('layouts.app', ['title' => 'Quotation Data',  'logo' => 'http://localhost/remsonrails/public/images/LOGO_REM.png'])


@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
          <style type="text/css">


          </style>

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark custStyleNav">
                        <ul class="nav nav-pills addcolor">
                            @include('layouts.quotation_head')

                        </ul>
                    </nav>

                    <style type="text/css">

                      .bkg{background-color: white;}
                    </style>

            <ul class="breadcrumb custStyleBread">
              <!-- style="position: absolute; margin-left: -400px; margin-top: -35px;" -->
            <a href="{{ route('quotations.quot_gen.rawquot', $order->id)}}"><li>Raw Quotation Data</li></a> /
            <li class="active">Raw Quotation Data</li>
            </ul>
            <body>
                <div class="card-body cbody">
                  <br>

                    <div id="wrapper">

    <fieldset class="page-header">

  <div class="clearfix"></div></div>
                <!-- </div> -->
<form method="POST" enctype="multipart/form-data" id="">
<!-- action="{{ route('quotations.store') }}" -->


    @csrf

    <div class="content" id="content">

    <!-- <img style="width: 100%; height: 15%;" src="{{ asset('images/head.jpg') }}"> -->

    <input type="hidden" name="" id="custs1in" value="{{ $customized_line['mgl_RIN'] }}">
    <input type="hidden" name="" id="custs2in" value="{{ $customized_line['glasNol_RIN'] }}">
    <table border="1">

      <tr style="background-color: #008a9f; color: white; font-size: 16px;">
        <th colspan="5" width="1500"><center>Site Measurement Sheet</center></th>

      </tr>

      <tr>
        <td>Party Name</td>
        <td class="bkg">

        {{ $order->custquot->customer_name }}</td>




        <td>Date</td>
        <td colspan="2" class="bkg">{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
      </tr>

      <tr>
        <td>Billing Name</td>
        <td class="bkg">{{ $order->custquot->customer_name }}</td>
        <td>Place</td>
        <td colspan="2" class="bkg">{{ $order->custquot->place }} - {{ $order->custquot->countrylist->country }}</td>
      </tr>

      <tr>
        <td >Billing Address</td>
        <td  class="bkg">
          {{ $order->custquot->address }} - {{ $order->custquot->countrylist->country }}
        </td>
        <td rowspan="4">Glass Type</td>
        <td  class="bkg" rowspan="4">
          @foreach($order->order_glass_types as $glastype)

            {{ $glastype->glasstype }} {{ $glastype->glassize1 }} <br>

          @endforeach
        </td>
      </tr>
        <tr><td></td>
<!--         <td>Size</td>
 -->      </tr>

      <tr>
        <td>Referance By </td>
        <td class="bkg">{{ $order->refby }}</td>
<!--         <td>Size</td>
 -->
        </tr>

        <tr>
        <td>Approx. RFT </td>
        <td class="bkg">{{ $order->approxiRFT }} </td>
        <!-- <td>
          <button type="button" class="btn btn-primary btn-sm showCal"><span class="glyphicon glyphicon-plus"></span>Conversion</button>
        </td> -->
        <!-- <td colspan="2">

          <a href="#" style="" class="card-link showmodalextra">Add Extra Glass</a>
          <a href="#" style="color: green;"class="card-link viewextra" data-uri="">View Store</a>
          <a href="#" style="color: red;" class="card-link clearall" data-uri="">Claer Store</a>
        </td> -->

        </tr>
      </table>

      <table border="1" id="addProd">
        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="6" width="1500"><center>Final Product Details</center></th>
        </tr>
        <tr style="background-color: #A9A9A9;">
          <th colspan="2">No.</th>
          <th>Product Name</th>
          <th>Product Type</th>
          <th>Product Cover</th>
          <th>Hand Rail</th>

        </tr>
        @foreach($order->order_product_details as $prod_details)
        <tr>
          <td colspan="2" class="bkg">{{ $prod_details->railingNo }}</td>
          <td class="bkg">{{ $prod_details->productName}}</td>
          <td class="bkg"><?php $cont = explode('Line', $prod_details->productType); echo $cont[1]; ?> </td>
          <td class="bkg">{{ $prod_details->productCover}}</td>
          <td class="bkg">{{ $prod_details->handRail}}</td>
        </tr>
        @endforeach
      </table>


        <!-- for space -->
        <table border="1" id="addProductColor">
        <tr style="background-color: #f5f5f5; font-size: 16px;">
          <th colspan="8" width="1500"><center>&emsp;</center></th>
        </tr>

        <tr style="background-color: #A9A9A9;">
          <th>No.</th>
          <th>Color Type</th>
          <th>Color (Code)</th>
        </tr>
        @foreach($order->order_product_colors as $prod_color)
        <tr>
          <td class="bkg">{{ $prod_color->railingNo }}</td>
          <td class="bkg">{{ $prod_color->productColor }}</td>
          <td class="bkg">{{ $prod_color->color }}</td>
        </tr>
        @endforeach
      </table>
<!-- for space -->
        <?php

          for($i = 0; $i < count($shape); $i++) {  //echo $order->order_railings[$i]['shapeName'];
        ?>

      <table border="1">
        <tr>
          <th colspan="6" width="1500"><center>&emsp;</center></th>
        </tr>

        <tr style="background-color: #e3e3e3; font-size: 16px;">
          <span id="notequal"></span>
          <th colspan="6" width="1500"><center>Railing - {{ $i+1 }}</center></th>
        </tr>

        <tr>
          <td width="100%" rowspan="22" class="bkg">
            <div style="position: absolute; margin-top: -140px; width: 30%; height: 10px;">
              <?php if ($name[$i] === 'customized.png') {?>
              <img style="width: 250px; height: 120px;" src="{{ asset('storage/'.$shape[$i]) }}" id="" alt="This file is not image">
            <?php }

            else { ?>

              <img src="{{ asset('images/images/'.$shape[$i]) }}" id="" alt="This file is not image">
            <?php }?>
          </div>

          <fieldset  style="width: 100%; background-color:  height: px;">
            <legend>Summary Report</legend>

              <div class="content-section" style="background-color: ; height: 105px;">

                <ul class="list-group" id="" style="list-style-type: none; color: #C71585;">
                  <?php for($k = $i; $k <= $i; $k++) {

                    if ($name[$k] === 'customized.png') { ?>
                        <li>{{ $customized_line['shapetype_RIN'] }}</li>
                        <li>{{ $customized_line['coner_RIN'] }}</li>
                        <li>{{ $customized_line['wc_RIN'] }}</li>
                        <li>{{ $customized_line['connt_RIN'] }}</li>
                        <li>{{ $customized_line['brcktype_RIN'] }}</li>
                        <li id="custs1"></li>
                        <li id="custs2"></li>

                    <?php }

                    if ($name[$k] === 'sline2.png') { ?>
                        <li>{{ $straight_line['shapetype_RIN'] }}</li>
                        <li>{{ $straight_line['coner_RIN'] }}</li>
                        <li>{{ $straight_line['wc_RIN'] }}</li>
                        <li>{{ $straight_line['connt_RIN'] }}</li>
                        <li>{{ $straight_line['brcktype_RIN'] }}</li>
                        <li>{{ $straight_line['mg_RIN'] }}</li>
                        <li>{{ $straight_line['conto_RIN'] }}</li>
                        <li>{{ $straight_line['glasNo_RIN'] }}</li>
                    <?php }

                    if ($name[$k] === 'ctype2.png') { ?>
                        <li>{{ $ctype_line['shapetype_RIN'] }}</li>
                        <li>{{ $ctype_line['coner_RIN'] }}</li>
                        <li>{{ $ctype_line['wc_RIN'] }}</li>
                        <li>{{ $ctype_line['connt_RIN'] }}</li>
                        <li>{{ $ctype_line['brcktype_RIN'] }}</li>
                        <li>{{ $ctype_line['mgl_RIN'] }}</li>
                        <li>{{ $ctype_line['glasNol_RIN'] }}</li>
                        <li>{{ $ctype_line['mgc_RIN'] }}</li>
                        <li>{{ $ctype_line['glasNoc_RIN'] }}</li>
                        <li>{{ $ctype_line['mgr_RIN'] }}</li>
                        <li>{{ $ctype_line['glasNor_RIN'] }}</li>

                    <?php }

                    if ($name[$k] === 'lshape.png') { ?>
                        <li>{{ $lshape_line['shapetype_RIN'] }}</li>
                        <li>{{ $lshape_line['coner_RIN'] }}</li>
                        <li>{{ $lshape_line['wc_RIN'] }}</li>
                        <li>{{ $lshape_line['connt_RIN'] }}</li>
                        <li>{{ $lshape_line['brcktype_RIN'] }}</li>
                        <li>{{ $lshape_line['mgv_RIN'] }}</li>
                        <li>{{ $lshape_line['glasNov_RIN'] }}</li>
                        <li>{{ $lshape_line['mgh_RIN'] }}</li>
                        <li>{{ $lshape_line['glasNoh_RIN'] }}</li>
                    <?php } } ?>

                </ul>
              </div>
          </fieldset>
          </td>

          <td></td><td></td><td></td><td></td><td></td>
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
          <td style="width: 60px;"><input style="width: 60px;" readonly id="" value="{{ $bracket_accery[$i]['bracket50Qty'] }}" type="number" name="r1brack50qty[]"></td>
          <td>W/C</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="" type="number" name="accesWCQty[]" value="{{ $bracket_accery[$i]['accesWCQty'] }}"></td>
        </tr>
        <tr>
          <td width="600"></td>
          <td>75</td>
          <td style="width: 60px;"><input style="width: 60px;" readonly id="" value="{{ $bracket_accery[$i]['bracket75Qty'] }}" type="number" name="r1brack75qty[]"></td>
          <td>Corner</td>
        <td style="width: 60px;"><input type="number" readonly name="accesCornerQty[]" id="" value="{{ $bracket_accery[$i]['accesCornerQty'] }}" style="width: 60px;"></td>

        </tr>

      <tr>
        <td width="600"></td>
        <td>100</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack100qty[]" id="" value="{{ $bracket_accery[$i]['bracket100Qty'] }}" style="width: 60px;"></td>
        <td>Connector</td>
        <td style="width: 60px;"><input type="number" readonly name="accesConnectorQty[]" id="" value="{{ $bracket_accery[$i]['accesConnectorQty'] }}" style="width: 60px;"></td>

      </tr>

      <tr>
        <td width="600"></td>
        <td>150</td>
        <td style="width: 60px;"><input type="number" readonly name="r1brack150qty[]" id="" value="{{ $bracket_accery[$i]['bracket150Qty'] }}" style="width: 60px;"></td>
        <td>End Cap B/H</td>
        <td style="width: 60px;"><input type="number" readonly name="accesEndcapQty[]" id="" value="{{ $bracket_accery[$i]['accesEndcapQty'] }}" style="width: 60px;"></td>
      </tr>

      <tr>
        <td width="600"></td>
        <td><input type="text" name="bracketFP[]" value="{{ $bracket_accery[$i]['bracketFP'] }}" readonly id="" style="width: 150px; text-align: left;"></td>
        <td style="width: 60px;"><input type="number" readonly name="bracketFPQty[]" id="" value="{{ $bracket_accery[$i]['bracketFPQty'] }}" style="width: 60px;"></td>
        <td>
{{--              <button style="" type="button" class="btn btn-danger btn-sm" id=""><span class="glyphicon glyphicon-plus"></span>Clear all</button>--}}
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
        <td><input style="width: 150px;" readonly type="text"  class="" name="sideCover[]" id="" value="{{ $bracket_accery[$i]['sideCover'] }}">

        </td>
        <td style="width: 60px;"><input style="width: 60px;" class="" type="number" name="sideCoverQty[]" readonly id="" value="{{ $bracket_accery[$i]['sideCoverQty'] }}"></td>
        <td style="width: 60px;">
        <input readonly id="" required class="" style="width: 90px;" type="text" name="acceshandRail[]" value="{{ $bracket_accery[$i]['acceshandRail'] }}">
        </td>
        <td style="width: 60px;"><input style="width: 60px;" class="" type="number" name="acceshandRailQty[]" readonly id="" value="{{ $bracket_accery[$i]['acceshandRailQty'] }}"></td>
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
      <?php } ?>
    </table>
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
