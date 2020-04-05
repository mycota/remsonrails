<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Logs;
use App\Transporter;
use App\Customer;
use App\Rules\AlphaOnly;
use App\QuotationOrder;
use App\QuotationOrderRailing;
use App\ExtraGlassType;
use App\GlassType;
use App\ProductDetail;
use App\ProductColor;
use App\RailingReport;
use App\TemporalImage;
use PDF;
use DB;


class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(Auth::user()->id)
        {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View quotations', 'ip_address'=>$request->ip()]);
                
            return view('quotations.index')->with('orders', QuotationOrder::where(['deleted'=> 1, 'orderStatus'=>'Pending'])->paginate(5));
                

        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $options = Customer::where('deleted', 1)->get();
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View add quotations modal', 'ip_address'=>$request->ip()]);

        return response()->json($options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        for ($i = 0; $i < $request->nofproducts; $i++) {
            
            if ($request->shapeName[$i] === "white.png") {
                $i++;
                return response()->json(['error'=>'Please select a picture in Railing - '.$i]);
         }
        }

        for ($i = 0; $i < $request->nofproducts; $i++) {
            
            if ($request->shapeName[$i] === "customized.png") {
                $newi = $i+1;
                $rails = TemporalImage::where(['quotOrdID'=>$request->quotOrdID, 'railingNo'=>$newi])->first();

            if (!$rails) {
                return response()->json(['error'=>'Please provide a customized picture for Railing - '.$newi]);
            }
            }
        }

        if ( ($request->nofproducts != $request->nofrailings) || ($request->nofproducts != $request->nofcolors) ) {

            return response()->json(['error'=>'Soryy the number of products do \n not match the number of railings from php']);
        }
        else{
            // inserting the quotation head
            $order = QuotationOrder::create(['user_id'=>$request->user_id, 'quotOrdID'=>$request->quotOrdID, 'customer_id'=>$request->customer_id, 'refby'=>$request->refby, 'approxiRFT'=>$request->approxiRFT, 'noOfRailing'=>$request->nofproducts]);


            // Insert the one on the form and check if there is extra glass types, get them and insert in the new GT table
            $order->order_glass_types()->create(['quotOrdID'=>$request->quotOrdID, 'glasstype'=>$request->glassType, 'glassize1'=>$request->glasSize1, 'glassize2'=>$request->glasSize2]);

            $extraglas = ExtraGlassType::where('quotationID', $request->quotOrdID)->get();
            if ($extraglas) {
                foreach ($extraglas as $extragla) {
                
                    $order->order_glass_types()->create(['quotOrdID'=>$request->quotOrdID, 'glasstype'=>$extragla->glasstype, 'glassize1'=>$extragla->glassize1, 'glassize2'=>$extragla->glassize2]);
                }
            }

            // insert array of values from the product details
            $productDs = $request->productName;
            for($count = 0; $count<count($productDs); $count++){
                $getnew = $count+1;
                $order->order_product_details()->create(['quotOrdID' => $request->quotOrdID, 'railingNo'=>$getnew, 'productName'=>$productDs[$count], 'productType'=>$request->productType[$count], 'productCover'=>$request->productCover[$count], 'handRail'=>$request->handRail[$count]]);
            }

            // insert array of values from the product color
            $productcolors = $request->productColor;
            for($count = 0; $count<count($productcolors); $count++){
                $ncount = $count + 1;
                $order->order_product_colors()->create(['quotOrdID' => $request->quotOrdID, 'railingNo'=>$ncount, 'productColor'=>$productcolors[$count], 'color'=>$request->color[$count].$request->colorInput_R[$count]]);
            }

            // insert array of values from the railing to QuotationOrderRailing
            $lineshapes = $request->shapeName;
            for($count = 0; $count <count($lineshapes); $count++){

                $newcount = $count+1;

                if ($lineshapes[$count] == "customized.png") {

                    $image = TemporalImage::where(['quotOrdID'=>$request->quotOrdID, 'railingNo'=>$newcount])->first();
                    if ($image) {

                        $order->order_railings()->create(['quotOrdID' => $request->quotOrdID, 'railingNo'=>$newcount, 'shapeName'=>$request->shapeName[$count], 'imageFile'=>$image->image, 'bracket50Qty'=>$request->r1brack50qty[$count], 'bracket75Qty'=>$request->r1brack75qty[$count], 'bracket100Qty'=>$request->r1brack100qty[$count], 'bracket150Qty'=>$request->r1brack150qty[$count], 'bracketFP'=>$request->bracketFP[$count], 'bracketFPQty'=>$request->bracketFPQty[$count], 'sideCover'=>$request->sideCover[$count], 'sideCoverQty'=>$request->sideCoverQty[$count], 'accesWCQty'=>$request->accesWCQty[$count], 'accesCornerQty'=>$request->accesCornerQty[$count], 'accesConnectorQty'=>$request->accesConnectorQty[$count], 'accesEndcapQty'=>$request->accesEndcapQty[$count], 'acceshandRail'=>$request->acceshandRail[$count], 'acceshandRailQty'=>$request->acceshandRailQty[$count]]);
                    }
                }
                else{ # if not customized

                    $order->order_railings()->create(['quotOrdID' => $request->quotOrdID, 'railingNo'=>$newcount, 'shapeName'=>$request->shapeName[$count], 'bracket50Qty'=>$request->r1brack50qty[$count], 'bracket75Qty'=>$request->r1brack75qty[$count], 'bracket100Qty'=>$request->r1brack100qty[$count], 'bracket150Qty'=>$request->r1brack150qty[$count], 'bracketFP'=>$request->bracketFP[$count], 'bracketFPQty'=>$request->bracketFPQty[$count], 'sideCover'=>$request->sideCover[$count], 'sideCoverQty'=>$request->sideCoverQty[$count], 'accesWCQty'=>$request->accesWCQty[$count], 'accesCornerQty'=>$request->accesCornerQty[$count], 'accesConnectorQty'=>$request->accesConnectorQty[$count], 'accesEndcapQty'=>$request->accesEndcapQty[$count], 'acceshandRail'=>$request->acceshandRail[$count], 'acceshandRailQty'=>$request->acceshandRailQty[$count]]);
                }
            }

            // insert array of values from the railings to RailingReport
            for($count = 0; $count <count($lineshapes); $count++){

                $newcount = $count+1;

                $order->order_railing_reports()->create(['quotOrdID' => $request->quotOrdID, 'railingNo'=>$newcount, 'shapetype_RIN'=>$request->shapetype_RIN[$count], 'coner_RIN'=>$request->coner_RIN[$count], 'wc_RIN'=>$request->wc_RIN[$count], 'connt_RIN'=>$request->connt_RIN[$count], 'encap_RIN'=>$request->encap_RIN[$count], 'brcktype_RIN'=>$request->brcktype_RIN[$count], 'mg_RIN'=>$request->mg_RIN[$count], 'mgl_RIN'=>$request->mgl_RIN[$count], 'conto_RIN'=>$request->conto_RIN[$count], 'glasNo_RIN'=>$request->glasNo_RIN[$count], 'glasNol_RIN'=>$request->glasNol_RIN[$count], 'mgc_RIN'=>$request->mgc_RIN[$count], 'glasNoc_RIN'=>$request->glasNoc_RIN[$count], 'mgr_RIN'=>$request->mgr_RIN[$count], 'glasNor_RIN'=>$request->glasNor_RIN[$count], 'mgv_RIN'=>$request->mgv_RIN[$count], 'glasNov_RIN'=>$request->glasNov_RIN[$count], 'mgh_RIN'=>$request->mgh_RIN[$count], 'glasNoh_RIN'=>$request->glasNoh_RIN[$count]]);
            }

            # remove all extra glass type and temporal images from the respective table s for this quotation and anything more than a day
            DB::table('extraglasstypes')->where('quotationID', '=', $request->quotOrdID)->delete();
            DB::table('temporal_images')->where('quotOrdID', '=', $request->quotOrdID)->delete();
            DB::table('extraglasstypes')->whereDate('created_at', '<', date('Y-m-d'))->delete();
            DB::table('temporal_images')->whereDate('created_at', '<', date('Y-m-d'))->delete();

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added new quotation', 'ip_address'=>$request->ip()]);

            return response()->json(['success'=>'Quotation successfully placed !!']);
            
            }
        }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatequot(Request $request, $id)
    {
        $quotorder = QuotationOrder::findorfail($id);
        // dd($quotorder->customer_id);
        
        return view('quotations.quot_gen.generatequot')->with(['quot'=>$quotorder]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // list($cust, $railN) = explode('.', $id);
        // dd($cust.' '.$railN);
        
        // dd($cust);
        $customer = Customer::findorfail($id);

        // Empty this table once you refresh the page or it reloads
        // DB::delete('delete from extraglasstypes');
        // DB::table('extraglasstypes')->where('quotationID', '=', $id)->delete();

        if ($customer) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View add site measurement form', 'ip_address'=>$request->ip()]);

            $time = time();
            $quotOrdID = $customer->id."-".$time;
            return view('quotations.show')->with(['customer' => $customer, 'quotOrdID'=> $quotOrdID]);
        }

        else{

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Error occured and could not view the add site measurement sheet, view the customers list', 'ip_address'=>$request->ip()]);

            return redirect()->route('customers.index')->with(['customers'=>Customer::where('deleted', 1)->paginate(10), 'warning'=>'Something went wrong, try again later.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dropdown(Request $request)
    {
        $options = Customer::where('deleted', 1)->get();
        return response()->json($options);
    }
}
