<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExtraGlassType;
use DB;

class GlassTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('Here');
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
        
        ExtraGlassType::create(['quotationID'=>$request->quotOrdIDM, 'glasstype'=>$request->glasstypem, 'glassize1'=>$request->glassize1m, 'glassize2'=>$request->glassize2m]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $stored = ExtraGlassType::where('quotationID', $id)->get();
        // Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View add quotations modal', 'ip_address'=>$request->ip()]);

        return response()->json($stored);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        if (strpos($id, '-') !== false) {

            DB::table('extraglasstypes')->where('quotationID', '=', $id)->delete();
             return "all done";
            // DB::table('users')->delete();
            // DB::table('users')->truncate();
            // DB::delete('delete from extraglasstypes');
            // DB::delete('delete from extraglasstypes where quotationID = ?',[$id]);
        }
        
        else {

            $find = ExtraGlassType::find($id);

            if ($find) {
                ExtraGlassType::destroy($id);
                return 'done';
            }
            else{ return 'not done'; }
        }
        
    }
}