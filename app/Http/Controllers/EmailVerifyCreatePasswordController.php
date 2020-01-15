<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Logs;


class EmailVerifyCreatePasswordController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('');
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

        $pwd =$this->validateRequest();

        if (checkpassword($pwd)) {
            
            return view('auth.createpassword')->with(['warwarning'=>checkpassword($pwd),'email'=>request('email'), 'token'=>request('token')]);

        }
        else
        {
            $user->update($this->validateRequest());
            return redirect()->route('auth.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email,Request $request)
    {
        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($email, $verifyToken, Request $request)
    {
        dd('Create pass');
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


    public function validateRequest()
    {
        return request()->validate([

            'password' => ['required', 'string', 'min:8', 'confirmed'],  
        ]);
    }


    public function emailverifybyuser($email, $verifyToken, Request $request)
    {
        $user = User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->first();

        if ($user) {

            //User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->update(['status'=>1, 'verifyToken'=>NULL, 'email_verified_at'=>time()]);
            Logs::create(['user_id'=>$user->id, 'action'=>'Email verified by: '.$user->name, 'ip_address'=>$request->ip()]);

        return view('emails.emailVerify')->with(['success'=>'Your email is verify', 'email'=>$email]);
        }
    }


    public function checkpassword($pwd)
    {
        $error='';
        if( strlen($pwd) < 8 ) {
        $error .= "Password too short! 
        ";
        }

        if( !preg_match("#[0-9]+#", $pwd) ) {
        $error .= "Password must include at least one number! 
        ";
        }

        if( !preg_match("#[a-z]+#", $pwd) ) {
        $error .= "Password must include at least one letter! 
        ";
        }

        if( !preg_match("#[A-Z]+#", $pwd) ) {
        $error .= "Password must include at least one CAPS! 
        ";
        }

        if( !preg_match("#\W+#", $pwd) ) {
        $error .= "Password must include at least one symbol! 
        ";
        }

        if($error){
        return "Password validation failure(your choise is weak): $error";
        }
    }


    public function createPassword($email, $verifyToken, Request $request)
    {

        $user = User::where(['email'=>$email])->first();

        Logs::create(['user_id'=>$user->id, 'action'=>'View createpassword form ', 'ip_address'=>$request->ip()]);

        return view('auth.createpassword')->with(['email'=>$mail, 'token'=>$verifyToken]);

    }
}
