<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Logs;
use App\Transporter;
use DB;
use App\Rules\CheckName;
use Illuminate\Support\Facades\Auth;



class TransporterController extends Controller
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
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View transports list', 'ip_address'=>$request->ip()]);
        }

        return view('transports.index')->with('transports', Transporter::where('deleted', 1)->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Transporter::create(


            $request->validate([
                'user_id' => ['required', 'numeric'],    
                'transport' => ['required', 'string', 'max:255', 'unique:transporters', new CheckName($request->transport)],
                'description' => ['required', 'string', 'max:255', new CheckName($request->description)],
            ]));
            
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added a new transporter', 'ip_address'=>$request->ip()]);

        return view('transports.index')->with('transports', Transporter::where('deleted', 1)->paginate(10));

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
    public function edit($id)
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
    public function destroy(Request $request, $id)
    {
        $transport = Transporter::findorfail($id);

        if ($transport) {

            Transporter::where('id', $id)->update(array('deleted'=> 0));

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added a new transporter', 'ip_address'=>$request->ip()]);

            return redirect()->route('transports.index')->with(['transports'=> Transporter::where('deleted', 1)->paginate(10), 'success'=>'Data deleted .....']);

        }

        else {

            return redirect()->route('transports.index')->with(['transports'=> Transporter::where('deleted', 1)->paginate(10), 'warning'=>'Sorry some error occured data not deleted .....']);

        }

    }
}
