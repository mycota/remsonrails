<?php

namespace App\Http\Controllers;

use App\CustomClass\CustomValidations;
use App\Notifications\NotifyUsers;
use App\Transportered;
use App\User;
use foo\bar;
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
use App\PaymentTerm;
use App\CountryCurrencySymbol;
use App\Product;
use App\ProductDescription;
use App\FinalQuotation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use PDF;
use Mpdf;
use DB;

use Mpdf\Css\DefaultCss;

use Mpdf\Language\LanguageToFont;
use Mpdf\Language\ScriptToLanguage;

use Mpdf\Ucdn;


class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->hasAnyRoles(['Admin'])) {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View pending quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.index')->with('orders', QuotationOrder::where(['deleted' => 1])->orderBy('id', 'desc')->paginate(5));
        }
        elseif (Auth::user()->hasAnyRoles(['Accounts'])) {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View confirmed quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.confirmed_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Confirmed'])->orderBy('id', 'desc')->paginate(5));
        }
        else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View pending quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('quotations.index')->with('orders', QuotationOrder::where(['deleted' => 1, 'user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(10));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending_quot(Request $request)
    {

        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View pending quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.pending_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Pending'])->orderBy('id', 'desc')->paginate(5));
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View pending quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            $orde = QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Pending', 'user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(10);
            //            if ($orde->isEmpty()){dd('True'); }
            return view('quotations.quot_gen.pending_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Pending', 'user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(10));
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepared_quot(Request $request)
    {

        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View prepared quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.prepared_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Prepared'])->orderBy('id', 'desc')->paginate(5));
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View prepared quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('quotations.quot_gen.prepared_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Prepared', 'user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(5));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmed_quot(Request $request)
    {
//        dd('Why not here');
        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View confirmed quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.confirmed_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Confirmed'])->orderBy('id', 'desc')->paginate(5));
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View confirmed quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('quotations.quot_gen.confirmed_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Confirmed', 'user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(5));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transported_quot(Request $request)
    {
//        dd('Why not here');
        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View transported quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.trans.transported_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Transported'])->orderBy('id', 'desc')->paginate(5));
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View transported quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('quotations.trans.transported_quot')->with('orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Transported', 'user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(5));
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
        Logs::create(['user_id' => Auth::user()->id, 'action' => 'View add quotation modal', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

        return response()->json($options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, $id)
    {
        $checkId = new CustomValidations();
        if ($checkId->isnumbers($id)) {
            return back()->with('warning', 'Sorry this quotation was not confirm try again !!!');
        }

        $order = QuotationOrder::find($id);
        if ($order){
            if ($order->prepared_date != null and $order->confirm_date == null){
                $newPerson = $order->persons.','.Auth::user()->name.' '.Auth::user()->last_name;

                DB::table('quotation_orders')->where('id', $id)->update(array('orderStatus' => 'Confirmed', 'persons'=>$newPerson, 'confirm_date'=> now()));
                Logs::create(['user_id' => Auth::user()->id, 'action' => 'Confirmed quotation', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
                return back()->with('success', 'Quotation confirmed');
            }
            else{
                return back()->with('warning', 'Sorry this quotation was not confirm try again !!!');
            }

        }
        else{
            return back()->with('warning', 'Sorry this quotation was not confirm try again !!!');
        }
//                dd(now());
//        $options = Customer::where('deleted', 1)->get();
//        Logs::create(['user_id' => Auth::user()->id, 'action' => 'View add quotation modal', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
//
//        return response()->json($options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return "Why here";

        for ($i = 0; $i < $request->nofproducts; $i++) {

            if ($request->shapeName[$i] === "white.png") {
                $i++;
                return response()->json(['error' => 'Please select a picture in Railing - ' . $i]);
            }
        }

        for ($i = 0; $i < $request->nofproducts; $i++) {

            if ($request->shapeName[$i] === "customized.png") {
                $newi = $i + 1;
                $rails = TemporalImage::where(['quotOrdID' => $request->quotOrdID, 'railingNo' => $newi])->first();

                if (!$rails) {
                    return response()->json(['error' => 'Please provide a customized picture for Railing - ' . $newi]);
                }
            }
        }

        $quotNo = QuotationOrder::where('quotOrdID', $request->quotOrdID)->first();
        if ($quotNo) {
            return response()->json(['error' => 'Sorry this quotation already exist, refresh the page and start a new one']);
        }

        $quotglastype = GlassType::where('quotOrdID', $request->quotOrdID)->first();
        if ($quotglastype) {
            return response()->json(['error' => 'Sorry this quotation already exist, refresh the page and start a new one']);
        }

        $quotprod = ProductDetail::where('quotOrdID', $request->quotOrdID)->first();
        if ($quotprod) {
            return response()->json(['error' => 'Sorry this quotation already exist, refresh the page and start a new one']);
        }

        $quotcolor = ProductColor::where('quotOrdID', $request->quotOrdID)->first();
        if ($quotcolor) {
            return response()->json(['error' => 'Sorry this quotation already exist, refresh the page and start a new one']);
        }

        $quotrail = QuotationOrderRailing::where('quotOrdID', $request->quotOrdID)->first();
        if ($quotrail) {
            return response()->json(['error' => 'Sorry this quotation already exist, refresh the page and start a new one']);
        }

        $quotrailrepot = RailingReport::where('quotOrdID', $request->quotOrdID)->first();
        if ($quotrailrepot) {
            return response()->json(['error' => 'Sorry this quotation already exist, refresh the page and start a new one']);
        }


        if (($request->nofproducts != $request->nofrailings) || ($request->nofproducts != $request->nofcolors)) {

            return response()->json(['error' => 'Soryy the number of products do \n not match the number of railings from php']);
        } else {
            // inserting the quotation head
            $order = QuotationOrder::create(['user_id' => $request->user_id, 'quotOrdID' => $request->quotOrdID, 'customer_id' => $request->customer_id, 'refby' => $request->refby, 'approxiRFT' => $request->approxiRFT, 'noOfRailing' => $request->nofproducts, 'persons'=>Auth::user()->name.' '.Auth::user()->last_name]);


            // Insert the one on the form and check if there is extra glass types, get them and insert in the new GT table
            $order->order_glass_types()->create(['quotOrdID' => $request->quotOrdID, 'glasstype' => $request->glassType, 'glassize1' => $request->glasSize1, 'glassize2' => $request->glasSize2]);

            $extraglas = ExtraGlassType::where('quotationID', $request->quotOrdID)->get();
            if ($extraglas) {
                foreach ($extraglas as $extragla) {

                    $order->order_glass_types()->create(['quotOrdID' => $request->quotOrdID, 'glasstype' => $extragla->glasstype, 'glassize1' => $extragla->glassize1, 'glassize2' => $extragla->glassize2]);
                }
            }

            // insert array of values from the product details
            $productDs = $request->productName;
            for ($count = 0; $count < count($productDs); $count++) {
                $getnew = $count + 1;
                $order->order_product_details()->create(['quotOrdID' => $request->quotOrdID, 'railingNo' => $getnew, 'productName' => $productDs[$count], 'productType' => $request->productType[$count], 'productCover' => $request->productCover[$count], 'handRail' => $request->handRail[$count]]);
            }

            // insert array of values from the product color
            $productcolors = $request->productColor;
            for ($count = 0; $count < count($productcolors); $count++) {
                $ncount = $count + 1;
                $order->order_product_colors()->create(['quotOrdID' => $request->quotOrdID, 'railingNo' => $ncount, 'productColor' => $productcolors[$count], 'color' => $request->color[$count] . $request->colorInput_R[$count]]);
            }

            // insert array of values from the railing to QuotationOrderRailing
            $lineshapes = $request->shapeName;
            for ($count = 0; $count < count($lineshapes); $count++) {

                $newcount = $count + 1;

                if ($lineshapes[$count] == "customized.png") {

                    $image = TemporalImage::where(['quotOrdID' => $request->quotOrdID, 'railingNo' => $newcount])->first();
                    if ($image) {

                        $order->order_railings()->create(['quotOrdID' => $request->quotOrdID, 'railingNo' => $newcount, 'shapeName' => $request->shapeName[$count], 'imageFile' => $image->image, 'bracket50Qty' => $request->r1brack50qty[$count], 'bracket75Qty' => $request->r1brack75qty[$count], 'bracket100Qty' => $request->r1brack100qty[$count], 'bracket150Qty' => $request->r1brack150qty[$count], 'bracketFP' => $request->bracketFP[$count], 'bracketFPQty' => $request->bracketFPQty[$count], 'sideCover' => $request->sideCover[$count], 'sideCoverQty' => $request->sideCoverQty[$count], 'accesWCQty' => $request->accesWCQty[$count], 'accesCornerQty' => $request->accesCornerQty[$count], 'accesConnectorQty' => $request->accesConnectorQty[$count], 'accesEndcapQty' => $request->accesEndcapQty[$count], 'acceshandRail' => $request->acceshandRail[$count], 'acceshandRailQty' => $request->acceshandRailQty[$count]]);
                    }
                } else { # if not customized

                    $order->order_railings()->create(['quotOrdID' => $request->quotOrdID, 'railingNo' => $newcount, 'shapeName' => $request->shapeName[$count], 'bracket50Qty' => $request->r1brack50qty[$count], 'bracket75Qty' => $request->r1brack75qty[$count], 'bracket100Qty' => $request->r1brack100qty[$count], 'bracket150Qty' => $request->r1brack150qty[$count], 'bracketFP' => $request->bracketFP[$count], 'bracketFPQty' => $request->bracketFPQty[$count], 'sideCover' => $request->sideCover[$count], 'sideCoverQty' => $request->sideCoverQty[$count], 'accesWCQty' => $request->accesWCQty[$count], 'accesCornerQty' => $request->accesCornerQty[$count], 'accesConnectorQty' => $request->accesConnectorQty[$count], 'accesEndcapQty' => $request->accesEndcapQty[$count], 'acceshandRail' => $request->acceshandRail[$count], 'acceshandRailQty' => $request->acceshandRailQty[$count]]);
                }
            }

            // insert array of values from the railings to RailingReport
            for ($count = 0; $count < count($lineshapes); $count++) {

                $newcount = $count + 1;

                $order->order_railing_reports()->create(['quotOrdID' => $request->quotOrdID, 'railingNo' => $newcount, 'shapetype_RIN' => $request->shapetype_RIN[$count], 'coner_RIN' => $request->coner_RIN[$count], 'wc_RIN' => $request->wc_RIN[$count], 'connt_RIN' => $request->connt_RIN[$count], 'encap_RIN' => $request->encap_RIN[$count], 'brcktype_RIN' => $request->brcktype_RIN[$count], 'mg_RIN' => $request->mg_RIN[$count], 'mgl_RIN' => $request->mgl_RIN[$count], 'conto_RIN' => $request->conto_RIN[$count], 'glasNo_RIN' => $request->glasNo_RIN[$count], 'glasNol_RIN' => $request->glasNol_RIN[$count], 'mgc_RIN' => $request->mgc_RIN[$count], 'glasNoc_RIN' => $request->glasNoc_RIN[$count], 'mgr_RIN' => $request->mgr_RIN[$count], 'glasNor_RIN' => $request->glasNor_RIN[$count], 'mgv_RIN' => $request->mgv_RIN[$count], 'glasNov_RIN' => $request->glasNov_RIN[$count], 'mgh_RIN' => $request->mgh_RIN[$count], 'glasNoh_RIN' => $request->glasNoh_RIN[$count]]);
            }

            # remove all extra glass type and temporal images from the respective table s for this quotation and anything more than a day
            DB::table('extraglasstypes')->where('quotationID', '=', $request->quotOrdID)->delete();
            DB::table('temporal_images')->where('quotOrdID', '=', $request->quotOrdID)->delete();
            DB::table('extraglasstypes')->whereDate('created_at', '<', date('Y-m-d'))->delete();
            DB::table('temporal_images')->whereDate('created_at', '<', date('Y-m-d'))->delete();

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Added new quotation', 'ip_address' => $request->ip(), 'os_browser_info' => $request->userAgent()]);

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Created a new quotation', 'ip_address' => $request->ip(), 'os_browser_info' => $request->userAgent()]);

            if (Auth::user()->id == $order->user_id and Auth::user()->hasAnyRoles(['Admin'])){
                // no need to notify since he/she will generate the quotation
                return response()->json(['success' => 'Quotation successfully placed, wait and generate the final quotation!!_' . $order->id, 'userType'=>'Admin']);
            }
            else {
                $allAdmins = array();
                $users = User::all();
                foreach ($users as $user) {
                    if (implode(', ', $user->roles()->get()->pluck('name')->toArray()) === 'Admin') {
                        $allAdmins[] = $user->id;
                    }
                }
                $usrs = User::whereIn('id', $allAdmins)->get();
                Notification::send($usrs, new NotifyUsers(QuotationOrder::find($order->id)));

                return response()->json(['success' => 'Quotation successfully placed Admin is notified so he/she will work on it!!_' . $order->id, 'userType'=>'Normal']);
            }
        }
    }

    /**
     * show the form for adding a tranporter to a specified quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_transporter(Request $request, $id){


        if (Auth::user()->hasAnyRoles(['Accounts', 'Admin'])) {

            $getOrder = QuotationOrder::findorfail($id);
            $getTransporter = Transporter::all();

            return view('quotations.quot_gen.add_transporter')->with(['order'=>$getOrder, 'trans'=>$getTransporter]);
        }
        else{
            return back()->with('warning', 'Sorry you don\'t have access only accountants do');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_trans_quot(Request $request)
    {
        if (Auth::user()->hasAnyRoles(['Accounts', 'Admin'])) {

            $getValid = new CustomValidations();

            $error = '';
            if (request()->file('bill') === null) {
                return response()->json(['error'=>"<p> Sorry please add bill </p>"]);
            }

            if (request()->file('receipt') === null) {
                return response()->json(['error'=>"<p> Sorry please add receipt </p>"]);
            }

            //  $billname = $request->file('receipt')->getClientOriginalName();
            $billExtension = $request->file('bill')->extension();
            $billSize = $request->file('bill')->getSize();
//            return $billSize;

            $receiptExtension = $request->file('receipt')->extension();
            $receiptSize = $request->file('receipt')->getSize();

            if (!in_array($billExtension, ['png', 'jpeg', 'gif', 'jpg', 'pdf'])){
                $error .= "<p> Sorry file must be image type or PDF format </p>";
            }
            if ($billSize > 2000001){
                $error .= "<p> Sorry file size must not exceed 2MB </p>";
            }
            if (!in_array($receiptExtension, ['png', 'jpeg', 'gif', 'jpg', 'pdf'])){
                $error .= "<p> Sorry file must be image type or PDF format </p>";
            }
            if ($receiptSize > 2000001){
                $error .= "<p> Sorry file size must not exceed 2MB </p>";
            }

            if ($getValid->isnumbers($request->quot_id)){
                $error .= "<p> Sorry something is wrong try again </p>";
            }

            if ($getValid->isnumbers($request->trans_id)){
                $error .= "<p> Sorry something is wrong try again </p>";
            }

            if ($getValid->isDate($request->date)){
                $error .= "<p> Sorry date format is wrong </p>";
            }

            if ($getValid->dateMore($request->date)){
                $error .= "<p> Sorry date cannot be more than today's date </p>";
            }


//            if ($getValid->ifDataExist('App\Transportered', 'quotation_order_id', $request->quot_id)){
//                $error .= "<p> Sorry there is bill and receipt for this quotation, kindly update it from the transported tab</p>";
//            }

            if ($error === ''){
                $user = User::findorfail(Auth::user()->id);
                $getOrder = QuotationOrder::findorfail($request->quot_id);
                $getTrans = Transporter::findorfail($request->trans_id);
                $newPerson = $getOrder->persons.','.Auth::user()->name.' '.Auth::user()->last_name;

                if ($getValid->ifDataExist('App\Transportered', 'quotation_order_id', $request->quot_id)) {

                    $tran = Transportered::where('quotation_order_id', $request->quot_id)->get();
                    foreach ($tran as $trn){
                        Storage::delete('public/'.$trn->bill); // remove old file from the storage
                        Storage::delete('public/'.$trn->receipt); // remove old file from the storage
                        Transportered::destroy($trn->id);
                    }

                    $trans = $user->user_tranport()->create(['quotation_order_id'=>$getOrder->id, 'transporter_id'=>$getTrans->id, 'date'=>$request->date]);

                    if ($trans){
                        $this->storeImage($trans);
                        DB::table('quotation_orders')->where('id', $getOrder->id)->update(array('orderStatus' => 'Transported', 'persons'=>$newPerson, 'transported_date'=> now()));

                    }
                    else{
                        return response()->json(['error'=>"<p>Sorry data not save, try again</p>"]);
                    }

                    return response()->json(['success'=>"<p>Data is successfully saved</p>"]);

                }

                $trans = $user->user_tranport()->create(['quotation_order_id'=>$getOrder->id, 'transporter_id'=>$getTrans->id, 'date'=>$request->date]);
                if ($trans){
                    $this->storeImage($trans);
                    DB::table('quotation_orders')->where('id', $getOrder->id)->update(array('orderStatus' => 'Transported', 'persons'=>$newPerson, 'transported_date'=> now()));

                }
                else{
                    return response()->json(['error'=>"<p>Sorry data not save, try again</p>"]);
                }

                return response()->json(['success'=>"<p>Data is successfully saved</p>"]);

            }
            else{
                return response()->json(['error'=>$error]);
            }
        }
        else{
            return response()->json(['error'=>"<p>Sorry you don't have access only accountants do</p>"]);
        }
    }

    private function storeImage($trans){
        if (request()->has('bill') and request()->has('receipt')) {
            $trans->update([
                'bill' => request()->bill->store('uploads/bill_receipt_files', 'public')]);
            $trans->update([
                'receipt' => request()->receipt->store('uploads/bill_receipt_files', 'public')]);
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
        $payTerms = PaymentTerm::all();
        $countries = CountryCurrencySymbol::all();
        // dd($quotorder->customer_id);
        // Getting the products and hand rails images

        $product_images = array();
        $hand_rail_images = array();

        foreach ($quotorder->order_product_details as $prod) {

            if (strpos($prod->productName, 'Line') !== false) {
                $name = ProductDescription::where('description', $prod->productName)->get();
                foreach ($name as $nam) {
                    if (count($product_images) <= 2) {
                        $product_images[] = $nam->product_image->image_name;
                    }
                }
            }
            if (strpos($prod->handRail, 'Hand') !== false) {
                $name = ProductDescription::where('description', $prod->handRail)->get();
                foreach ($name as $nam) {
                    if (count($hand_rail_images) <= 2) {
                        $hand_rail_images[] = $nam->product_image->image_name;
                    }
                }
            }
        }

        // dd($hand_rail_images);
        if (Auth::user()->hasAnyRoles(['Admin'])) {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View generate quotation page', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.generatequot')->with(['quot' => $quotorder, 'payterms' => $payTerms, 'countries' => $countries, 'product_images' => $product_images, 'hand_rail_images' => $hand_rail_images]);
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to view the prepared quotations form', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return redirect()->route('quotations.index')->with(['orders' => QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Pending', 'user_id' => Auth::user()->id])->paginate(5), 'warning' => "Sorry you don't have the right to generate quotation, Only admin can so !!"]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finalquotation(Request $request)
    {
        // dd(count($request->amountper));
        $error = '';
        if (Auth::user()->hasAnyRoles(['Admin'])) {
            for ($i = 0; $i < count($request->amountper); $i++) {

                if ($request->amountper[$i] === null) {
                    $error .= "<p>Please enter all values for rate per RFT on row $i, rate must be currency only eg. 2909 or 1248.90</p>";
                }
            }

            if ($request->glasshihtvalue === null) {
                $error .= "<p> Please enter a value for the glass height !!! </p>";
            }


            if ($request->payterms === null) {
                $error .= "<p>Please select payment terms for this quotation !!!</p>";
            }

            $order = QuotationOrder::find($request->orderID);
            $quot_final = FinalQuotation::find($request->orderID);
            $quot_final = DB::table("final_quotations")->where('quotation_order_id', $request->orderID)->count();

            if ($quot_final > 0) {
                $error .= 'Sorry a quotation already exist for this order.';
            }

            if (!$order) {
                $error .= "<p>Sorry the quotation you are generating does not exist, please try again or create another for the customer !!!</p>";
            }

            if ($error === '') {

                $prices = '';
                $paymentterms = '';
                for ($i = 0; $i < count($request->amountper); $i++) {
                    $newi = $i + 1;
                    if ($i == count($request->amountper) - 1) {
                        $prices .= $request->amountper[$i];
                    } else {
                        $prices .= $request->amountper[$i] . ', ';
                    }
                }

                for ($i = 0; $i < count($request->payterms); $i++) {
                    $newi = $i + 1;
                    if ($i == count($request->payterms) - 1) {
                        $paymentterms .= $request->payterms[$i];
                    } else {
                        $paymentterms .= $request->payterms[$i] . ', ';
                    }
                }

                $currncy = explode(' | ', $request->paycurrency);

                $currncy_value = $currncy[2] . ' ' . $currncy[3];

                $savefinal = FinalQuotation::create(['user_id' => Auth::user()->id, 'customer_id' => $order->customer_id, 'quotation_order_id' => $order->id, 'quotOrdID' => $order->quotOrdID, 'nofrailings' => $order->noOfRailing, 'rates_per_rft' => $prices, 'glassHeight' => $request->glassheight, 'glassUnit' => $request->glassunit, 'values' => $request->glasshihtvalue, 'gst' => $request->gst18, 'transport' => $request->transport, 'payment_terms' => $paymentterms, 'payment_currency' => $currncy_value]);

                $newStatus = "$order->orderStatus,Prepared";
                DB::table('quotation_orders')->where('id',  $order->id)->update(array('orderStatus' => 'Prepared', 'persons'=>Auth::user()->name.' '.Auth::user()->last_name, 'prepared_date'=> now()));

                if (!$savefinal) {

                    return response()->json(['error' => 'Sorry Something went wrong try again.']);
                } else {
                    Logs::create(['user_id' => Auth::user()->id, 'action' => 'Generated a new quotation', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

                    return response()->json(['success' => 'Quotation successfully generated !!']);
                }
            } else {
                return response()->json(['error' => $error]);
            }
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to prepared quotations', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return response()->json(['error' => "Sorry you don't the right to perform this action, Only admin can do so !!"]);
        }
    }


    /**
     * Show the form for showing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalquotationpdf(Request $request, $id)
    {
        $quotorder = QuotationOrder::findorfail($id);

        $final_quot = FinalQuotation::findorfail($quotorder->order_final_quot->id);


        // dd($quotorder->customer_id);
        // Getting the products and hand rails images

        // dd($quotorder->order_final_quot->id);

        $product_images = array();
        $hand_rail_images = array();
        $rftvalues = explode(', ', $final_quot->rates_per_rft);


        $paymentTerms = explode(', ', $final_quot->payment_terms);

        foreach ($quotorder->order_product_details as $prod) {

            if (strpos($prod->productName, 'Line') !== false) {
                $name = ProductDescription::where('description', $prod->productName)->get();
                foreach ($name as $nam) {
                    if (count($product_images) <= 2) {
                        $product_images[] = $nam->product_image->image_name;
                    }
                }
            }
            if (strpos($prod->handRail, 'Hand') !== false) {
                $name = ProductDescription::where('description', $prod->handRail)->get();
                foreach ($name as $nam) {
                    if (count($hand_rail_images) <= 2) {
                        $hand_rail_images[] = $nam->product_image->image_name;
                    }
                }
            }
        }

        // dd($hand_rail_images);
        // dd($rftvalues);
        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts']) or Auth::user()->id === $quotorder->user_id) {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View prepared quotation export page ', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.finalquotationpdf')->with(['quot' => $quotorder, 'final_quot' => $final_quot, 'rftvalues' => $rftvalues, 'product_images' => $product_images, 'hand_rail_images' => $hand_rail_images, 'paymentTerms' => $paymentTerms]);
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to ulter the url to view a prepared quotation he/she did not created', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return redirect()->route('quotations.quot_gen.prepared_quot')->with(['orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Prepared', 'user_id' => Auth::user()->id])->paginate(5), 'warning' => "Sorry you don't have the right to view this file because it's not your quotation, Only admin can so !!"]);
        }
    }

    /**
     * Show the form for download a PDF the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadpdf(Request $request, $id)
    {
        $quotorder = QuotationOrder::findorfail($id);

        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts']) or Auth::user()->id === $quotorder->user_id) {

            $final_quot = FinalQuotation::findorfail($quotorder->order_final_quot->id);

            $product_images = array();
            $hand_rail_images = array();
            $rftvalues = explode(', ', $final_quot->rates_per_rft);


            $paymentTerms = explode(', ', $final_quot->payment_terms);

            foreach ($quotorder->order_product_details as $prod) {

                if (strpos($prod->productName, 'Line') !== false) {
                    $name = ProductDescription::where('description', $prod->productName)->get();
                    foreach ($name as $nam) {
                        if (count($product_images) <= 2) {
                            $product_images[] = $nam->product_image->image_name;
                        }
                    }
                }
                if (strpos($prod->handRail, 'Hand') !== false) {
                    $name = ProductDescription::where('description', $prod->handRail)->get();
                    foreach ($name as $nam) {
                        if (count($hand_rail_images) <= 2) {
                            $hand_rail_images[] = $nam->product_image->image_name;
                        }
                    }
                }
            }

            $info['title'] = 'Customer Quotation';
            $info['quot'] = $quotorder;
            $info['final_quot'] = $final_quot;
            $info['rftvalues'] = $rftvalues;
            $info['product_images'] = $product_images;
            $info['hand_rail_images'] = $hand_rail_images;
            $info['paymentTerms'] = $paymentTerms;


            $filename = $quotorder->quotOrdID . ' ' . $quotorder->custquot->customer_name . '.pdf';
            $mpdf = new \Mpdf\Mpdf();

            $html = \View::make('quotations.quot_gen.invoice')->with($info);
            $html = $html->render();

            $mpdf->setHeader('Customer Name: |' . $quotorder->custquot->customer_name . '|{PAGENO}');
            $mpdf->setFont('underline | line-through | normal (line-through = strike-through)');

            $stylesheet = file_get_contents(url('css/bootstrap_mpdf.css'));

            $mpdf->WriteHTML($html);
            $mpdf->Output($filename, 'I');

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View quotation pdf for customer ' . $quotorder->custquot->customer_name, 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to ulter the url to view a prepared quotation pdf file he/she did not created', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return redirect()->route('quotations.quot_gen.prepared_quot')->with(['orders', QuotationOrder::where(['deleted' => 1, 'orderStatus' => 'Prepared', 'user_id' => Auth::user()->id])->paginate(5), 'warning' => "Sorry you don't have the right to view this file because it's not your quotation, Only admin can so !!"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $customer = Customer::find($id);
        $products = Product::where('deleted', 1)->get();
        if ($customer) {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View add site measurement form', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            $time = time();
            $quotOrdID = $customer->id . "-" . $time;
            return view('quotations.show')->with(['customer' => $customer, 'quotOrdID' => $quotOrdID, 'products' => $products]);
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Error occured and could not view the add site measurement sheet, view the customers list', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('customers.index')->with(['customers' => Customer::where('deleted', 1)->paginate(10), 'warning' => 'No data exist for this customer']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $id)
    {
        Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to alter the url to view restricted page', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('welcome');
    }

    /**
     * Show the form for showing the raw quotation created
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rawquotation(Request $request, int $id)
    {
        $order = QuotationOrder::findorfail($id);
        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts']) or Auth::user()->id === $order->user_id) {
            $shape = array();
            $name = array();

            $straight_line = array('shapetype_RIN' => '', 'coner_RIN' => '', 'wc_RIN' => '', 'connt_RIN' => '', 'brcktype_RIN' => '', 'mg_RIN' => '', 'conto_RIN' => '', 'glasNo_RIN' => '');
            $ctype_line = array('shapetype_RIN' => '', 'coner_RIN' => '', 'wc_RIN' => '', 'connt_RIN' => '', 'brcktype_RIN' => '', 'mgl_RIN' => '', 'glasNol_RIN' => '', 'mgc_RIN' => '', 'glasNoc_RIN' => '', 'mgr_RIN' => '', 'glasNor_RIN' => '');
            $lshape_line = array('shapetype_RIN' => '', 'coner_RIN' => '', 'wc_RIN' => '', 'connt_RIN' => '', 'brcktype_RIN' => '', 'mgv_RIN' => '', 'glasNov_RIN' => '', 'mgh_RIN' => '', 'glasNoh_RIN' => '');
            $customized_line = array('shapetype_RIN' => '', 'coner_RIN' => '', 'wc_RIN' => '', 'connt_RIN' => '', 'brcktype_RIN' => '', 'mgl_RIN' => '', 'glasNol_RIN' => '');

            foreach ($order->order_railings as $rail) {
                if ($rail->shapeName === 'customized.png') {
                    $shape[] = $rail->imageFile;
                    $name[] = $rail->shapeName;
                } else {
                    $shape[] = $rail->shapeName;
                    $name[] = $rail->shapeName;
                }
            }

            foreach ($order->order_railing_reports as $report) {
                if ($report->shapetype_RIN === 'Straight line.') {
                    $straight_line['shapetype_RIN'] = $report->shapetype_RIN;
                    $straight_line['coner_RIN'] = $report->coner_RIN;
                    $straight_line['wc_RIN'] = $report->wc_RIN;
                    $straight_line['connt_RIN'] = $report->connt_RIN;
                    $straight_line['brcktype_RIN'] = $report->brcktype_RIN;
                    $straight_line['mg_RIN'] = $report->mg_RIN;
                    $straight_line['conto_RIN'] = $report->conto_RIN;
                    $straight_line['glasNo_RIN'] = $report->glasNo_RIN;
                }

                if ($report->shapetype_RIN === 'C-Type shape.') {
                    $ctype_line['shapetype_RIN'] = $report->shapetype_RIN;
                    $ctype_line['coner_RIN'] = $report->coner_RIN;
                    $ctype_line['wc_RIN'] = $report->wc_RIN;
                    $ctype_line['connt_RIN'] = $report->connt_RIN;
                    $ctype_line['brcktype_RIN'] = $report->brcktype_RIN;
                    $ctype_line['mgl_RIN'] = $report->mgl_RIN;
                    $ctype_line['glasNol_RIN'] = $report->glasNol_RIN;
                    $ctype_line['mgc_RIN'] = $report->mgc_RIN;
                    $ctype_line['glasNoc_RIN'] = $report->glasNoc_RIN;
                    $ctype_line['mgr_RIN'] = $report->mgr_RIN;
                    $ctype_line['glasNor_RIN'] = $report->glasNor_RIN;
                }

                if ($report->shapetype_RIN === 'L-shape.') {
                    $lshape_line['shapetype_RIN'] = $report->shapetype_RIN;
                    $lshape_line['coner_RIN'] = $report->coner_RIN;
                    $lshape_line['wc_RIN'] = $report->wc_RIN;
                    $lshape_line['connt_RIN'] = $report->connt_RIN;
                    $lshape_line['brcktype_RIN'] = $report->brcktype_RIN;
                    $lshape_line['mgv_RIN'] = $report->mgv_RIN;
                    $lshape_line['glasNov_RIN'] = $report->glasNov_RIN;
                    $lshape_line['mgh_RIN'] = $report->mgh_RIN;
                    $lshape_line['glasNoh_RIN'] = $report->glasNoh_RIN;
                }
                if ($report->shapetype_RIN === 'Customized shape.') {
                    $customized_line['shapetype_RIN'] = $report->shapetype_RIN;
                    $customized_line['coner_RIN'] = $report->coner_RIN;
                    $customized_line['wc_RIN'] = $report->wc_RIN;
                    $customized_line['connt_RIN'] = $report->connt_RIN;
                    $customized_line['brcktype_RIN'] = $report->brcktype_RIN;
                    $customized_line['mgl_RIN'] = $report->mgl_RIN;
                    $customized_line['glasNol_RIN'] = $report->glasNol_RIN;
                }
            }

            $bracket_accery = array();

            foreach ($order->order_railings as $ord) {
                array_push($bracket_accery, array('bracket50Qty' => $ord->bracket50Qty, 'bracket75Qty' => $ord->bracket75Qty, 'bracket100Qty' => $ord->bracket100Qty, 'bracket150Qty' => $ord->bracket150Qty, 'bracketFP' => $ord->bracketFP, 'bracketFPQty' => $ord->bracketFPQty, 'sideCover' => $ord->sideCover, 'sideCoverQty' => $ord->sideCoverQty, 'accesWCQty' => $ord->accesWCQty, 'accesCornerQty' => $ord->accesCornerQty, 'accesConnectorQty' => $ord->accesConnectorQty, 'accesEndcapQty' => $ord->accesEndcapQty, 'acceshandRail' => $ord->acceshandRail, 'acceshandRailQty' => $ord->acceshandRailQty));
            }

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'View raw quotation data', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('quotations.quot_gen.rawquot')->with(['order' => $order, 'straight_line' => $straight_line, 'ctype_line' => $ctype_line, 'lshape_line' => $lshape_line, 'customized_line' => $customized_line, 'shape' => $shape, 'name' => $name, 'bracket_accery' => $bracket_accery]);
        } else {
            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to ulter the url to view a raw quotation he/she did not created', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
            //            return redirect()->route('quotations.quot_gen.prepared_quot')->with(['orders', QuotationOrder::where(['deleted'=> 1, 'orderStatus'=>'Prepared', 'user_id'=>Auth::user()->id])->paginate(5), 'warning'=>"Sorry you don't have the right to view this file because it's not your quotation, Only admin can so !!"]);
            return redirect()->back()->with(['warning' => "Sorry you don't have the right to view this file because it's not your quotation, Only admin can so !!"]);
        }
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
        Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to alter the url to view restricted page', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: Tried to alter the url to view restricted page', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('welcome');
    }

    public function dropdown(Request $request) // not used
    {
        $options = Customer::where('deleted', 1)->get();
        return response()->json($options);
    }
}
