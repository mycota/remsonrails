<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Logs;
use App\Transporter;
use App\Customer;
use App\Rules\AlphaOnly;
use App\QuotationOrder;
use App\QuotationOrderRailing;
use PDF;


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

            return view('quotations.index')->with('transports', Transporter::where('deleted', 1)->paginate(10));

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
        dd($request->validate([

            'user_id' => ['required', 'numeric'],
            'quotOrdID' => ['required', 'string', 'unique:quotation_order'],
            'customer_id' => ['required', 'numeric'],
            'refby' => ['string', 'max:255', new AlphaOnly($request->refby)],
            'approxiRFT' => ['numeric'],
            'glassTytpe' => ['required', 'string'],
            'glasSize1' => ['required', 'string'],
            'glasSize2' => ['string'],
            'productName' => ['required', 'string', new AlphaOnly($request->productName)],
            'productType' => ['required', 'string', new AlphaOnly($request->productType)],
            'productCover' => ['string', new AlphaOnly($request->productCover)],
            'handrail' => ['required', 'string', new AlphaOnly($request->handrail)],
            'productColor' => ['required', 'string', new AlphaOnly($request->productColor)],
            'color' => ['required', 'string', new AlphaOnly($request->color)],            
            ]));
        // dd($validateOrder);

        $validateRailing1 = $request->validate([

            // 'quotOrdID' => ['required', 'string', 'unique:quotation_order'],
            'r1glassheight' => ['required', 'string'],
            'r1brack75qty' => ['numeric'],
            'r1acceswcqty' => ['numeric'],
            'r1brack100qty' => ['numeric'],
            'r1accescorqty' => ['numeric'],
            'r1brack150qty' => ['numeric'],
            'r1accesconnqty' => ['numeric'],
            'r1brackother' => ['string'],
            'r1brackotherqty' => ['numeric'],
            'r1accesendcapqty' => ['numeric'],
            'r1side1' => ['required','string'],
            'r1side1qty' => ['required','numeric'],
            'r1hr1' => ['required','string'],
            'r1hr1qty' => ['required','numeric'],
        
        ]);

        if ($request->imgrail2 != 'white.png' && $request->imgrail3 != 'white.png') {
            
            // validate railing2 & 3 inputs
            $validateRailing2 = $request->validate([
                'r2glassheight' => ['required', 'string'],
                'r2brack75qty' => ['numeric'],
                'r2acceswcqty' => ['numeric'],
                'r2brack100qty' => ['numeric'],
                'r2accescorqty' => ['numeric'],
                'r2brack150qty' => ['numeric'],
                'r2accesconnqty' => ['numeric'],
                'r2brackother' => ['string'],
                'r2brackotherqty' => ['numeric'],
                'r2accesendcapqty' => ['numeric'],
                'r2side1' => ['required','string'],
                'r2side1qty' => ['required','numeric'],
                'r2hr1' => ['required','string'],
                'r2hr1qty' => ['required','numeric'],
            ]);


            $validateRailing3 = $request->validate([
                'r3glassheight' => ['required', 'string'],
                'r3brack75qty' => ['numeric'],
                'r3acceswcqty' => ['numeric'],
                'r3brack100qty' => ['numeric'],
                'r3accescorqty' => ['numeric'],
                'r3brack150qty' => ['numeric'],
                'r3accesconnqty' => ['numeric'],
                'r3brackother' => ['string'],
                'r3brackotherqty' => ['numeric'],
                'r3accesendcapqty' => ['numeric'],
                'r3side1' => ['required','string'],
                'r3side1qty' => ['required','numeric'],
                'r3hr1' => ['required','string'],
                'r3hr1qty' => ['required','numeric'],
            ]);

            // save order summary
            $order = QuotationOrder::create($validateOrder);

            // save railing1
            $railing1 = new QuotationOrderRailing();

            $railing1->quotOrdID = $request->quotOrdID;
            $railing1->shapeImage = $request->imgrail1;
            $railing1->glassHeight = $request->r1glassheight;
            $railing1->bracket75Qty = $request->r1brack75qty;
            $railing1->bracket100Qty = $request->r1brack100qty;
            $railing1->bracket150Qty = $request->r1brack150qty;
            $railing1->bracketOther = $request->r1brackother;
            $railing1->bracketOtherQty = $request->r1brackotherqty;
            $railing1->sideCover = $request->r1side1;
            $railing1->sideCoverQty = $request->r1side1qty;
            $railing1->accesCornerQty = $request->r1accescorqty;
            $railing1->accesWCQty = $request->r1acceswcqty;
            $railing1->accesConnectorQty = $request->r1accesconnqty;
            $railing1->accesEndcapQty = $request->r1accesendcapqty;
            $railing1->handRail = $request->r1hr1;
            $railing1->handRailQty = $request->r1hr1qty;
            $railing1->handrailNo = 1;
            $railing1->save();


            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Place order for processing.:', 'ip_address'=>$request->ip()]);
            return redirect()->route('quotations.index')->with(['transports' => Transporter::where('deleted', 1)->paginate(10), 'success'=>'3 Railing orders successfully placed wait for further processing.']);

        }

        elseif ($request->imgrail2 != 'white.png' && $request->imgrail3 === 'white.png') {
            
            // validate railing2 inputs
            $validateRailing3 = $request->validate([
                'r2glassheight' => ['required', 'string'],
                'r2brack75qty' => ['numeric'],
                'r2acceswcqty' => ['numeric'],
                'r2brack100qty' => ['numeric'],
                'r2accescorqty' => ['numeric'],
                'r2brack150qty' => ['numeric'],
                'r2accesconnqty' => ['numeric'],
                'r2brackother' => ['string'],
                'r2brackotherqty' => ['numeric'],
                'r2accesendcapqty' => ['numeric'],
                'r2side1' => ['required','string'],
                'r2side1qty' => ['required','numeric'],
                'r2hr1' => ['required','string'],
                'r2hr1qty' => ['required','numeric'],
            ]);

            // insert and leave


        }

        if ($request->imgrail2 === 'white.png' && $request->imgrail3 != 'white.png') {
            
            // validate railing3 inputs
            $validateRailing3 = $request->validate([
                'r3glassheight' => ['required', 'string'],
                'r3brack75qty' => ['numeric'],
                'r3acceswcqty' => ['numeric'],
                'r3brack100qty' => ['numeric'],
                'r3accescorqty' => ['numeric'],
                'r3brack150qty' => ['numeric'],
                'r3accesconnqty' => ['numeric'],
                'r3brackother' => ['string'],
                'r3brackotherqty' => ['numeric'],
                'r3accesendcapqty' => ['numeric'],
                'r3side1' => ['required','string'],
                'r3side1qty' => ['required','numeric'],
                'r3hr1' => ['required','string'],
                'r3hr1qty' => ['required','numeric'],
            ]);

            // insert and leave
        }


        
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
        $customer = Customer::findorfail($id);


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
