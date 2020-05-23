<?php

namespace App\Http\Controllers\Auth;

use App\Logs;
use DB;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Rules\IsPasswordStrong;
use App\Rules\CheckPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
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
        //
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
        // if (Auth::user()->id == $id) {
        //     return redirect()->route('admin.users.index')->with('warning', 'You cannot edit yourself.');
        // }

        return view('auth.passwords.changepass')->with(['user' => User::findorfail($id), 'roles' => Role::all()]);
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

        $this->validate($request, [

            'old_password' => ['required', 'string', 'min:8', new CheckPassword(request('old_password'))],
            'password' => ['required', 'string', 'min:8', 'confirmed', new IsPasswordStrong(request('password'))]],
        );

        DB::table('users')->where('id', $id)->update(array('password' => bcrypt(request('password'))));

        Logs::create(['user_id'=>$id, 'action'=>'Password successfully changed', 'ip_address'=>$request->ip()]);
        //00mohameD@@

        return redirect()->route('home')->with('success', "Your password has been change");

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('Here');
    }
}
