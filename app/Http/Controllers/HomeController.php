<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
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
        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Login', 'ip_address'=>$request->ip()]);
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View users list', 'ip_address'=>$request->ip()]);

            return view('home')->with('users', User::paginate(5));
        }
        elseif (Auth::user()->hasAnyRoles(['Sales'])) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Login', 'ip_address'=>$request->ip()]);
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip()]);
            return view('customers.index')->with('customers', Customer::paginate(5));
        }


        return redirect('logout');

    }
}
