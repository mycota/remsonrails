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
        if(Auth::user()->hasAnyRoles(['Admin', 'Accounts']))
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View transports list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('transports.index')->with('transports', Transporter::where('deleted', 1)->paginate(10));
        }
        else{
            return redirect()->back()->with(['warning'=>'You don\'t have access to this page']);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {
            $user = Transporter::create(
                $request->validate([
                    'user_id' => ['required', 'numeric'],
                    'transport' => ['required', 'string', 'max:255', 'unique:transporters', new CheckName($request->transport)],
                    'description' => ['required', 'string', 'max:255', new CheckName($request->description)],
                ]));

            Logs::create(['user_id' => Auth::user()->id, 'action' => 'Added a new transporter', 'ip_address' => $request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('transports.index')->with('transports', Transporter::where('deleted', 1)->paginate(10));
        }
        else{
            return redirect()->back()->with(['warning'=>'You don\'t have access to this page']);
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
        return view('welcome');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('welcome');
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
        return view('welcome');
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

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted transporter info.', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('transports.index')->with(['transports'=> Transporter::where('deleted', 1)->paginate(10), 'success'=>'Data deleted .....']);

        }

        else {

            return redirect()->route('transports.index')->with(['transports'=> Transporter::where('deleted', 1)->paginate(10), 'warning'=>'Sorry some error occured data not deleted .....']);

        }

    }
}
