<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
//use Auth;
use App\Logs;

use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasAnyRoles(['Admin'])) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Login...', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View users list ....', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('admin.users.index')->with('success', 'Welcome back: '.Auth::user()->name.' '.Auth::user()->last_name);
        }
        elseif (Auth::user()->hasAnyRoles(['Accounts'])) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Login', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
//            return view('customers.index')->with('customers', Customer::paginate(10));
            return redirect()->route('quotations.quot_gen.confirmed_quot')->with('success', 'Welcome back: '.Auth::user()->name.' '.Auth::user()->last_name);
        }

        elseif (Auth::user()->hasAnyRoles(['Sales'])) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Login', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('customers.index')->with('success', 'Welcome back: '.Auth::user()->name.' '.Auth::user()->last_name);

//            return view('customers.index')->with('customers', Customer::where(['user_id'=>Auth::user()->id])->paginate(10));
        }

        else{
            return view('auth.login');
        }


    }
}
