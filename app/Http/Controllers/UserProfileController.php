<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use DB;
use App\Rules\CheckName;
use App\Rules\CheckPhone;

class UserProfileController extends Controller
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
        return view('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = User::findorfail($id);
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View the profile', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('profile.show', ['id'=>$id])->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::findorfail($id);
        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View edit profile form', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
        return view('profile.edit')->with(['user' => User::findorfail($id), 'roles' => Role::all()]);
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
            'last_name' => ['required', 'string', 'max:255', new CheckName($request->name)],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:10', 'unique:users' . ($id ? ",id,$id" : ''),new CheckPhone($request->phone)],
            'gender' => ['required', 'string', 'max:6'],
        ])


        );

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Updated his info '.$user->name, 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
        // $this->storeImage($user);

        return redirect()->route('profile.show', $id)->with(['user' => User::findorfail($id), 'success' => 'You have updated your data']);
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


}
