<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Logs;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckName;
use App\Rules\CheckPhone;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
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
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip()]);


            return view('customers.index')->with('customers', Customer::where('deleted', 1)->paginate(10));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // another way of validation
        $validator = request()->validate([

            'user_id' => ['required', 'numeric'],
            'customer_name' => ['required', 'string', 'max:255', new CheckName($request->customer_name)],
            'phone' => ['required', 'string', 'max:10', 'unique:customers', new CheckPhone($request->phone)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'gender' => ['required', 'string', 'max:6'],
            'address' => ['required', 'string', 'max:255'],
            'place' => ['required', 'string', 'max:255'],
            ]);

        if (!$validator) {

            return redirect()->back()->withErrors($validator)->withInput()->with(['add'=>'add']);

        }
        else{

            $customer = Customer::create($validator);

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added a new customers list', 'ip_address'=>$request->ip()]);

            return view('customers.index')->with(['customers'=> Customer::where('deleted', 1)->paginate(10), 'success'=>'Customer added .....']);

        }

        // dd('Here now');

        // 
        

        // if ($customer) {
           
        //    Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added a new customers list', 'ip_address'=>$request->ip()]);

        //     return view('customers.index')->with(['customers'=> Customer::where('deleted', 1)->paginate(10), 'success'=>'Customer added .....']);

        // }

        
        // $time = time();
        // $custid = $customer->id;
        // $cloths = Cloth::all();
        // return redirect()->route('customers.index', $custid)->with(['success'=>'You have a new customer, place order now']);

        // dd(Auth::user()->id);
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
        return view('customers.edit')->with('customer', Customer::find($id));
        
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
        $customer = Customer::find($id);
        $customer->update($this->validateRequest());
        if ($customer) {
            return redirect()->route('customers.index')->with(['customer'=>Customer::find($id), 'success'=>'Customer data updated.']);
        }
        return redirect()->route('customers.index')->with(['customer'=>Customer::find($id), 'warning'=>'Customer data was not updated try again !!!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $cust = Customer::findorfail($id);
        if ($cust) {

            $toDcust = User::findorfail($id);

            // $user->roles()->detach();
            // $user->delete();
            DB::table('customers')->where('id', $id)->update(array('deleted' => 0));

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted a customer '.$toDcust->name, 'ip_address'=>$request->ip()]);

            return redirect()->route('customers.index')->with(['customers' => Customer::paginate(5), 'success' => 'Customer data deleted..']);

        }

        // $customer = Customer::findorfail($id);
        // $customer->delete();
        // return redirect()->route('customers.index')->with(['customers' => Customer::paginate(5), 'success' => 'Customer data deleted..']);

    }

    private function validateRequest()
    {
        return request()->validate([
            'user_id' => ['required', 'numeric'],
            'cust_name' => ['required', 'string', 'max:255'],
            'cust_email' => ['required', 'string', 'email', 'max:255'],
            'cust_gender' => ['required', 'string', 'max:6'],
            'cust_phone' => ['required', 'string', 'max:10'],
            'cust_address' => ['required', 'string', 'max:255'],

            
        ]);
    }

}
