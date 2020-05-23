<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>{{ $title }}</title>

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
            <span class="paid" style="text-decoration: underline">Quotations Report</span>

            </div>
                            <small>({{ $title }})</small>


                        </div>
                    </div>

                    <hr>


                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <h3 class="panel-title"><strong>Invoice Items</strong></h3>
                        </div> -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered " border="1" style="font-size: px;">
                    <thead style="background-color: #4682B4">
                    <tr >
                        <th >Date</th>
                        <th >Qout. No.</th>
                        <th >Customer</th>
                        <th width="100">No. of rails</th>
                        <th >Ref. by</th>
                        <th >Transporter</th>
                        <th >Status</th>
                        <th >By</th>


                        <!-- <th scope="col">Bracket</th> -->
                    </tr>
                    <tr><th colspan="8" >&emsp;</th></tr>
                    </thead>
                    <tbody >

                    @if($orders->isNotEmpty())
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ date('d-m-Y',strtotime($order->created_at )) }} </td>
                                <td>{{ $order->quotOrdID }} </td>
                                <td>{{ $order->custquot->customer_name }}</td>
                                <td>{{ $order->noOfRailing }} </td>
                                <td>{{ $order->refby }} </td>
                                @if($order->orderStatus == "Transported")
                                    <td>{{ $order->order_trans->trans_tranport->transport }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $order->orderStatus}}</td>
                                <td>{{ $order->userquot->name }} </td>

                            </tr>
                        @endforeach
                    @else
                        <td colspan="8"><strong style="color: red">No data found</strong></td>
                    @endif
            </table>
            <br/>
            </div>
        </div>
 <div class="invoice-col text-center"><img style="width: 50%; right: 800px;" src="http://localhost/remsonrails/public/images/leter_paddfbg.jpg"></div>
                    </div>
            </div>
        </body>
</html>
