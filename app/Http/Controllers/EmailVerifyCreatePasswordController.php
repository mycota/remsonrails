<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Logs;
use DB;
use DateTime;
use App\Rules\IsPasswordStrong;


class EmailVerifyCreatePasswordController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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

        $user = User::where('email', request('email'))->first();

        $this->validate($request, [

            'password' => ['required', 'string', 'min:8', 'confirmed', new IsPasswordStrong(request('password'))]]);


        $password = bcrypt(request('password'));

        // $user->update(array('password' => $password));
            // return redirect()->route('auth.login');
        DB::table('users')->where('id', $user->id)->update(array('password' => $password));

        Logs::create(['user_id'=>$user->id, 'action'=>'Password created successfully', 'ip_address'=>$request->ip()]);


        return redirect()->route('home')->with('success', "Your password has been change");

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email,Request $request)
    {
        $user = User::where(['email'=>$email])->first();

        Logs::create(['user_id'=>$user->id, 'action'=>'View create password form ', 'ip_address'=>$request->ip()]);

        return view('createpassword.createpassword')->with(['email'=>$email]);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($email, $verifyToken, Request $request)
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
    public function destroy($id)
    {
        return view('welcome');
    }

    public function emailverifybyuser($email, $verifyToken, Request $request)
    {
        $user = User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->first();

        if ($user) {


            $date = new DateTime();

            User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->update(['active'=>1, 'verifyToken'=>NULL, 'email_verified_at'=>$date->format('Y-m-d H:i:s')]);

            Logs::create(['user_id'=>$user->id, 'action'=>'Email verified by: '.$user->name, 'ip_address'=>$request->ip()]);

            return view('emails.account_verifi.emailVerify')->with(['email'=>$email]);
        }

        // Another attempt
        $userc = User::where(['email'=>$email])->first();


        if($userc->password == NULL){

            Logs::create(['user_id'=>$userc->id, 'action'=>'another attempt to create password by: '.$userc->name, 'ip_address'=>$request->ip()]);

            return view('emails.account_verifi.emailVerify')->with(['email'=>$email]);

        }



        return view('emails.account_verifi.sorry')->with(['email'=>$email]);


    }





    public function createPassword($emailid, Request $request)
    {

        return view('welcome');

        // $user = User::where(['email'=>$email])->first();

        // Logs::create(['user_id'=>$user->id, 'action'=>'View createpassword form ', 'ip_address'=>$request->ip()]);

        // return view('auth.createpassword')->with(['email'=>$mail, 'token'=>$verifyToken]);

    }
}
