<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Logs;
use App\Transporter;
use App\Customer;


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $customer = Customer::findorfail($id);
        if ($customer) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View add site measurement form', 'ip_address'=>$request->ip()]);


            return view('quotations.edit')->with(['customer' => $customer]);
        }

        else{

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Error occured and could not view the add site measurement sheet, view the customers list', 'ip_address'=>$request->ip()]);

            return redirect()->route('customers.index')->with(['customers'=>Customer::where('deleted', 1)->paginate(10), 'warning'=>'Something went wrong, try again later.']);
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
