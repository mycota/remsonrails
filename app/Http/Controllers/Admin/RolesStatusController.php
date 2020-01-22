<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Mail;

class RolesStatusController extends Controller
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
    public function edit($id, Request $request)
    {
        $user = User::findorfail($id);

        if (Auth::user()->id == $id) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'An atempt to edit self role', 'ip_address'=>$request->ip()]);

            return redirect()->route('admin.users.index')->with('warning', 'You cannot edit yourself.');
        }

        if ($user->email_verified_at == NULL) {
            return redirect()->route('admin.users.index')->with('warning', 'Sorry this user has not verify the email, please ask the person to do so.');

            
        }

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View user role edit form', 'ip_address'=>$request->ip()]);

        return view('admin.roles_status.edit')->with(['user' => User::findorfail($id), 'roles' => Role::all()]);
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
        if (Auth::user()->id == $id) {

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'An atempt to update self role', 'ip_address'=>$request->ip()]);

            return redirect()->route('admin.users.index')->with('warning', 'You cannot update yourself.');
        }

        $user = User::findorfail($id);
        $user->roles()->sync($request->roles);

        DB::table('users')->where('id', $id)->update(array('active' => $request->active));


        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Updated user role '.$user->name, 'ip_address'=>$request->ip()]);

        return redirect()->route('admin.users.index')->with('success', 'User role and status has been updated.');

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
}
