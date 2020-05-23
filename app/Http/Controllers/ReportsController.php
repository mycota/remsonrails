<?php

namespace App\Http\Controllers;

use App\CustomClass\CustomValidations;
use App\Logs;
use App\QuotationOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "Create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $caty = $request->caty;
        $users = $request->users;

        $error = $this->validateRequest($from_date, $to_date, $caty, $users);
        if ($error){
            return response()->json(['error'=>$error]);
        }
        else{
            $url = 'http://localhost/remsonrails/public/reports/'.$request->_token.'_'.$request->from_date.'_'.$request->to_date.'_'.$request->caty.'_'.$request->users.'_'.$request->_token;
            return response()->json(['url'=>$url]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getValues = explode('_', $id);
        if (Auth::user()->hasAnyRoles(['Admin'])){
            $from_date = $getValues[1];
            $to_date = $getValues[2];
            $caty = $getValues[3];
            $users = $getValues[4];
            $error = $this->validateRequest($from_date, $to_date, $caty, $users);
            $url = $getValues[0].'_'.$from_date.'_'.$to_date.'_'.$caty.'_'.$users.'_'.$getValues[5];

            if ($error === ''){

                $from = date('d-m-Y',strtotime($from_date ));
                $to = date('d-m-Y',strtotime($to_date ));

                if ($caty === 'All' and $users== 0){

                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59"]
                    )->get();

                    $megs = "Quotations generated from $from to $to";
                    return view('reports.report_form')->with(['orders'=>$orders, 'megs'=>$megs, 'url'=>$url]);
                }
                elseif ($caty === 'All' and $users != 0){
                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?) AND (user_id = ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59", $users]
                    )->get();
                    $user = User::find($users);
                    $megs = "Quotations generated from $from to $to for $user->name $user->last_name";
                    return view('reports.report_form')->with(['orders'=>$orders, 'megs'=>$megs, 'url'=>$url]);
                }

                elseif ($caty !== 'All' and $users != 0){
                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?) AND (orderStatus = ?) AND (user_id = ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59", $caty, $users]
                    )->get();
//                    return "Condition 3";
                    $user = User::find($users);
                    $megs = "$caty quotation from $from to $to for $user->name $user->last_name";
                    return view('reports.report_form')->with(['orders'=>$orders, 'megs'=>$megs, 'url'=>$url]);
                }

                elseif ($caty !== 'All' and $users == 0){
                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?) AND (orderStatus = ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59", $caty]
                    )->get();
                    $megs = "$caty quotation from $from to $to";
                    return view('reports.report_form')->with(['orders'=>$orders, 'megs'=>$megs, 'url'=>$url]);
                }

                else{
                    return "<h1>Data Not Found !!!!!!!!!!!!!!!</h1>";
                }
            }
            else{
                return back()->with(['warning'=>$error]);
            }
        }
    }

    private function validateRequest($from_date, $to_date, $caty, $users){

        $getValid = new CustomValidations();
        $error = '';
        if ($getValid->isDate($from_date) or $getValid->isDate($to_date)){
            $error .= "<p>Sorry enter proper date</p>";
        }

        if ($getValid->dateMore($from_date)){
            $error .= "<p>Sorry from date cannot be more than today's date</p>";
        }
        if ($getValid->ishumanNames($caty)){
            $error .= "<p>Sorry category must be leters only</p>";
        }

        if (!in_array($caty, ['All', 'Pending', 'Prepared', 'Confirmed', 'Transported'])){
            $error .= "<p>Sorry this category is not known</p>";
        }

        if ($getValid->isnumbers($users)){
            $error .= "<p>Sorry unknown user selected</p>";
        }

        if ($users != 0){
            if (!$getValid->ifDataExist('App\User', 'id', $users)){
                $error .= "<p>Sorry this user do not exist</p>";
            }
        }
        return $error;

    }

    public function generatePDF(Request $request, $id)
    {
        $getValues = explode('_', $id);
        if (Auth::user()->hasAnyRoles(['Admin'])){
            $from_date = $getValues[1];
            $to_date = $getValues[2];
            $caty = $getValues[3];
            $users = $getValues[4];
            $error = $this->validateRequest($from_date, $to_date, $caty, $users);
            $url = $getValues[0].'_'.$from_date.'_'.$to_date.'_'.$caty.'_'.$users.'_'.$getValues[5];

            if ($error === ''){

                $from = date('d-m-Y',strtotime($from_date ));
                $to = date('d-m-Y',strtotime($to_date ));

                if ($caty === 'All' and $users== 0){

                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59"]
                    )->get();

                    $megs = "Quotations generated from $from to $to";

                    $this->generate_PDF($orders, $megs);
                    Logs::create(['user_id' => Auth::user()->id, 'action' => 'View report pdf', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

                }
                elseif ($caty === 'All' and $users != 0){
                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?) AND (user_id = ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59", $users]
                    )->get();
                    $user = User::find($users);
                    $megs = "Quotations generated from $from to $to for $user->name $user->last_name";

                    $this->generate_PDF($orders, $megs);
                    Logs::create(['user_id' => Auth::user()->id, 'action' => 'View report pdf', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

                }

                elseif ($caty !== 'All' and $users != 0){
                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?) AND (orderStatus = ?) AND (user_id = ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59", $caty, $users]
                    )->get();
                    
                    $user = User::find($users);
                    $megs = "$caty quotation from $from to $to for $user->name $user->last_name";

                    $this->generate_PDF($orders, $megs);
                    Logs::create(['user_id' => Auth::user()->id, 'action' => 'View report pdf', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

                }

                elseif ($caty !== 'All' and $users == 0){
                    $orders = QuotationOrder::whereRaw(
                        "(created_at >= ? AND created_at <= ?) AND (orderStatus = ?)",
                        [$from_date." 00:00:00", $to_date." 23:59:59", $caty]
                    )->get();
                    $megs = "$caty quotation from $from to $to";

                    $this->generate_PDF($orders, $megs);
                    Logs::create(['user_id' => Auth::user()->id, 'action' => 'View report pdf', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

                }

                else{
                    return "<h1>Data Not Found !!!!!!!!!!!!!!!</h1>";
                }
            }
            else{
                return back()->with(['warning'=>$error]);
            }

        }
    }

    private function generate_PDF($orders, $megs){

        $info['title'] = $megs;
        $info['orders'] = $orders;

        $filename = $megs . '.pdf';
        $mpdf = new \Mpdf\Mpdf();
        $html = \View::make('reports.pdf.pdf_report')->with($info);
        $html = $html->render();

        $mpdf->setHeader('Report: |' . $megs . '|{PAGENO}');
//        $mpdf->setFont('underline | line-through | normal (line-through = strike-through)');
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        $mpdf->Output($filename, 'I');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo $id;
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
}
