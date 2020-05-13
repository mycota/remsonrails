<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClass\CustomValidations;
use App\Customer;
use App\User;
use App\Logs;
use App\CountryCurrencySymbol;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckName;
use App\Rules\CheckPhone;
use App\Rules\CheckAddress;
use App\QuotationOrder;

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
        //dd($request->userAgent());
        // dd(new CheckPhone($request->phone, 5));
        if (Auth::user()->hasAnyRoles(['Admin', 'Accounts']))
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return view('customers.index')->with('customers', Customer::where('deleted', 1)->paginate(10));
        }
        else
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
            return view('customers.index')->with('customers', Customer::where(['user_id'=>Auth::user()->id])->paginate(10));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('customers.create');

        $options = CountryCurrencySymbol::all();
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View add customer modal', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

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
        // another way of validation
        $custV = new CustomValidations();
        $error = '';
        if ($custV->isnumbers($request->country_currency_symbol_id)){
                $error .= "<p>Sorry invalid country selected.</p>";
        }

        if ($custV->ishumanNames($request->customer_name)){
                $error .= "<p>Sorry customer name must be letters only.</p>";
        }
        if ($custV->phone($request->phone)){
                $error .= "<p>Sorry phone number must be numbers only.</p>";
        }
        if ($custV->isEmailValid($request->email)){
                $error .= "<p>Sorry email is invalid.</p>";
        }
        if ($custV->ishumanNames($request->gender)){
                $error .= "<p>Sorry gender must be letters only.</p>";
        }
        if ($custV->anyLength($request->pincode, 6)){
                $error .= "<p>Sorry pincode must be numbers only.</p>";
        }
        if ($custV->isotherNamesSymbols($request->address)){
                $error .= "<p>Sorry address cannot have some symbols.</p>";
        }
        if ($custV->isotherNames($request->place)){
                $error .= "<p>Sorry customer name must be letters only.</p>";
        }
        if ($custV->ifDataExist('App\Customer', 'email', $request->email)){
                $error .= "<p>Sorry email already exist.</p>";
        }
        if ($custV->ifDataExist('App\Customer', 'phone', $request->phone)){
                $error .= "<p>Sorry phone number already exist.</p>";
        }
        if ($custV->ishumanNames($request->wherefrom)){
                $error .= "<p>Sorry refresh the page and try again.</p>";
                Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: Inspected the page and change wherefrom value', 'ip_address'=>$request->ip()]);
        }

        if ($error === '') {
//            dd("hfjfj");
            $user = User::find(Auth::user()->id);
            $customer = $user->customers()->create(['country_currency_symbol_id' => $request->country_currency_symbol_id, 'customer_name' => $request->customer_name, 'phone' => $request->phone, 'email' => $request->email, 'gender' => $request->gender, 'pincode' => $request->pincode, 'address' => $request->address, 'place' => $request->place]);

            if ($customer) {
//                 if ($request->wherefrom === "AddDirect") {
                Logs::create(['user_id' => Auth::user()->id, 'action' => 'Added a new customer', 'ip_address' => $request->ip(), 'os_browser_info' => $request->userAgent()]);
                return response()->json(['success' => 'Data save', 'url' => "http://localhost/remsonrails/public/quotations/$customer->id"]);
            }
        }
        else
            {
                return response()->json(['error' => $error]);
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
       if (Auth::user()->hasAnyRoles(['Admin', 'Accounts'])) {
           Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
           $custQuot = QuotationOrder::where(['customer_id' => $id, 'deleted' => 1])->paginate(10);
           return view('customers.show')->with(['custQuots' => $custQuot, 'customer' => Customer::find($id)]);
       }
       else
       {
          $custQuot = QuotationOrder::where(['customer_id' => $id, 'user_id'=>Auth::user()->id, 'deleted' => 1])->paginate(10);
          $id2 = '';
          $cust = Customer::where(['id'=>$id, 'user_id'=>Auth::user()->id])->get();
          if ($cust->isEmpty()){
              return redirect()->back()->with(['warning'=>"You don't have access to this customer data, because you didin't add this customer, only admin does"]);
          }

          foreach ($cust as $cut)
          {
              $id2 = $cut->id;
          }
          Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View customers list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
           return view('customers.show')->with(['custQuots' => $custQuot, 'customer' => Customer::find($id2)]);
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
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Violation: alter the url @ customer.edit', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
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
        $customer = Customer::findorfail($id);

        // dd($request->user_id);

        $customer->update(

            $request->validate([

            'user_id' => ['required', 'numeric'],
            'country_currency_symbol_id' => ['required', 'numeric'],
            'customer_name' => ['required', 'string', 'max:255', new CheckName($request->customer_name)],
            'phone' => ['required', 'string', 'max:10', new CheckPhone($request->phone), 'unique:customers' . ($id ? ",id,$id" : '')],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers' . ($id ? ",id,$id" : '')],
            'gender' => ['required', 'string', 'max:6'],
            'pincode' => ['required', 'string', 'max:6'],
            'address' => ['required', 'string', 'max:255', new CheckAddress($request->address)],
            'place' => ['required', 'string', 'max:255', new CheckName($request->place)],

        ]));

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Update customer data', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

        return redirect()->route('customers.index')->with(['customer'=>Customer::where('deleted', 1)->paginate(10), 'success'=>'Customer data updated.']);

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

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted a customer '.$toDcust->name, 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('customers.index')->with(['customers' => Customer::paginate(5), 'success' => 'Customer data deleted..']);

        }
    }



}
