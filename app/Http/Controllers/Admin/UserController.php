<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Events\QuotationInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Mail;
use App\Mail\verifyEmail;
use App\Rules\CheckName;
use App\Rules\CheckPhone;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $allUsers = User::where('deleted', 1)->get();
            return response()->json($allUsers);
        }
       // event(new QuotationInfo('What is going on with you here'));
        if(Auth::user()->hasAnyRoles(['Admin']))
        {
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View users list', 'ip_address'=>$request->ip()]);
            return view('admin.users.index')->with('users', User::where('deleted', 1)->paginate(10));
        }
        else{
            return back()->with(['warning'=>"Sorry access denied"]);
        }

        // $user = User::where('active', 0)->paginate(3);



    }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request)
     {
         Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: alter the url @ admin.users.create', 'ip_address' => $request->ip()]);
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
        $user = User::create(


            $request->validate([

                'name' => ['required', 'string', 'max:255', new CheckName($request->name)],
                'last_name' => ['required', 'string', 'max:255', new CheckName($request->last_name)],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:10', 'unique:users', new CheckPhone($request->phone)],
                'gender' => ['required', 'string', 'max:6'],
            ])


        );


        DB::table('users')->where('id', $user->id)->update(array('verifyToken' => Str::random(60),));

        $userRole = Role::where('id', request('role'))->first();
        $user->roles()->attach($userRole);

        $pass = ['users' => User::paginate(5), 'success' => 'A new user have been added and email is sent to their mail'];

        // Send email to user after creating the user
        $thisUser = User::findorfail($user->id);

        $this->sendEmail($thisUser);

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added new user and email is sent to their mail', 'ip_address'=>$request->ip()]);

        return redirect()->route('admin.users.index')->with($pass);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Has been move to the uerprofilecontroller
    public function show(Request $request, $id)
    {
        Logs::create(['user_id' => Auth::user()->id, 'action' => 'Violation: alter the url @ admin.users.show', 'ip_address' => $request->ip()]);
        return view('welcome');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

//      Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View edit user form', 'ip_address'=>$request->ip()]);
        $custCount = "App\Customer";
        $custCount = $custCount::where('user_id', $id)->count();
        $logCount = "App\Logs";
        $logCount = $logCount::where('user_id', $id)->count();
        $quot = "App\QuotationOrder";
        $pendQuotCount = $quot::where(['user_id'=> $id, 'orderStatus'=>'Pending'])->count();
        $preQuotCount = $quot::where(['user_id'=> $id, 'orderStatus'=>'Prepared'])->count();
        $confQuotCount = $quot::where(['user_id'=> $id, 'orderStatus'=>'Confirmed'])->count();
        $transQuotCount = $quot::where(['user_id'=> $id, 'orderStatus'=>'Transported'])->count();
        $allQuotCount = $quot::where('user_id', $id)->count();

        $numbers = array($custCount, $logCount, $pendQuotCount, $preQuotCount, $confQuotCount, $transQuotCount, $allQuotCount);

        return view('admin.users.edit')->with(['user' => User::findorfail($id), 'numbers' => $numbers]);
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
        $user = User::findorfail($id);
        $user->update(

            $request->validate([

            'name' => ['required', 'string', 'max:255', new CheckName($request->name)],
            'last_name' => ['required', 'string', 'max:255', new CheckName($request->last_name)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users' . ($id ? ",id,$id" : '')],
            'phone' => ['required', 'string', 'max:10', 'unique:users' . ($id ? ",id,$id" : ''), new CheckPhone($request->phone)],
            'gender' => ['required', 'string', 'max:6'],
        ])

        );

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Updated user info '.$user->name, 'ip_address'=>$request->ip()]);

        $pass = ['users' => User::paginate(5), 'success' => 'A user data have been updated'];
        return redirect()->route('admin.users.index')->with($pass);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (Auth::user()->id == $id) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'An attempt to delete self', 'ip_address'=>$request->ip()]);

            return redirect()->route('admin.users.index')->with('warning', 'You cannot delete yourself.');
        }

        $user = User::findorfail($id);
        if ($user) {

            $toDuser = User::findorfail($id);

            // $user->roles()->detach();
            // $user->delete();
            DB::table('users')->where('id', $id)->update(array('deleted' => 0));

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted a user '.$toDuser->name, 'ip_address'=>$request->ip()]);

            return redirect()->route('admin.users.index')->with('success', 'User has been remove.');
        }

        // User::destroy($id);
        // return redirect()->route('admin.users.index')->with('warning', 'This user cannot be deleted.');
    }


    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }



}
