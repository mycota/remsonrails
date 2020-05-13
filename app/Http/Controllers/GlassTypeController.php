<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use App\Logs;
use App\ExtraGlassType;
use DB;
use App\TemporalImage;
use Validator;
class GlassTypeController extends Controller
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
        // return $request->image;
        ExtraGlassType::create(['quotationID'=>$request->quotOrdIDM, 'glasstype'=>$request->glasstypem, 'glassize1'=>$request->glassize1m, 'glassize2'=>$request->glassize2m]);

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added extra glass type', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd($id);
        $stored = ExtraGlassType::where('quotationID', $id)->get();

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View extra glass type', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

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
        // check if there is a railing with a customized image already there
        $validator = Validator::make($request->all(), [
        'cust_railingNo' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
        ]);

        if ($validator->passes()) {

            $quotid = $id;
            $railNo = $request->cust_railingNo;

            $rails = TemporalImage::where(['quotOrdID'=>$quotid, 'railingNo'=>$railNo])->get();
            // or this too  DB::table('temporal_images')->where([['railingNo', '=', $railNo], ['quotOrdID', '=', $quotid]])->get();

            if ($rails) {

                foreach($rails as $rail) {
                    Storage::delete('public/'.$rail->image);

                    DB::table('temporal_images')->where('railingNo', '=', $railNo)->delete();
                }
            }


            $tem = TemporalImage::create(['quotOrdID'=>$quotid, 'railingNo'=>$railNo]);
            $this->storeImage($tem);


            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Store image for customized quotation', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return response()->json(['success'=>'done']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    private function storeImage($tem){
        if (request()->has('image')) {
            $tem->update([
                'image' => request()->image->store('uploads/customized_images', 'public')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if (strpos($id, '-') !== false) {

            DB::table('extraglasstypes')->where('quotationID', '=', $id)->delete();

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'System action, to delete extra glass type', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

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
