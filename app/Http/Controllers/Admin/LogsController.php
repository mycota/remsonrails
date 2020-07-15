<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Logs;
use App\User;
// use App\CountryCurrencySymbol;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(Auth::user()->hasAnyRoles(['Admin']))
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View user logs', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('admin.logs.index')->with('logs', Logs::paginate(5));
        }
        else
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.index', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return redirect()->back()->with(['warning' => "Sorry page not found!!"]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.create', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
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
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.store', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd("Am here, good ......");
        if(Auth::user()->hasAnyRoles(['Admin'])) {
            $user = User::find($id);
            if ($user) {
                Logs::create(['user_id' => Auth::user()->id, 'action' => 'View a user logs', 'ip_address' => $request->ip(), 'os_browser_info' => $request->userAgent()]);
                return view('admin.logs.show')->with(['logs' => Logs::where('user_id', $id)->paginate(5), 'user' => $user]);
            } else {
                Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: alter the url @ logs.show', 'ip_address' => $request->ip(), 'os_browser_info' => $request->userAgent()]);
                return redirect()->back()->with(['warning' => "Sorry user not found !!"]);
            }
        }
        else
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.show', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return redirect()->back()->with(['warning' => "Sorry page not found !!"]);

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
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.edit', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
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
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.update', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
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
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ logs.destroy', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('welcome');
    }
}
