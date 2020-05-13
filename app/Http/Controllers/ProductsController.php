<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Logs;
use App\Product;
use App\ProductDescription;
use App\ProductType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Mail;
use App\Mail\verifyEmail;
use App\Rules\CheckName;
use App\Rules\CheckPhone;
use App\Rules\CheckAddress;

class ProductsController extends Controller
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
            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View products list', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);
        }

        return view('products.index')->with('products', Product::where('deleted', 1)->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = ProductDescription::all();
        return response()->json($products);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // DB::transaction(function () {

        $validateProd = $request->validate([

            'user_id' => ['required', 'numeric'],
            'product_name' => ['required', 'string', 'max:255', 'unique:products', new CheckName($request->product_name)],
            'qty' => ['required', 'numeric'],
            'pcs_rft' => ['required', 'string'],

            ]);

        $validateDespt = $request->validate([

            'description' => ['required', 'string', new CheckAddress($request->description)],

            ]);

        $validateType = $request->validate([

            'type' => ['required', 'string', new CheckAddress($request->description)],

            ]);



            $product = Product::create($validateProd);


            $product->product_despt()->create(['description' => $request->description]);

            $product->product_type()->create(['type' => $request->type]);


            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added a new product', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('products.index')->with(['products'=> Product::where('deleted', 1)->paginate(10), 'success'=> 'Product added .....']);


        // }, 5);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('welcome');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'View manager product type and description', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

        return view('products.edit')->with(['products'=>Product::findorfail($id), 'descriptions'=>ProductDescription::where('product_id', $id)->paginate(50), 'types'=>ProductType::where('product_id', $id)->paginate(50)]);
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

        if ($request->item === 'AddType' or $request->item === 'AddDespt') {

            $product = Product::findorfail($id);

            if ($request->item === 'AddType') {

                $types = $request->type;

                for($count = 0; $count<count($types); $count++){
                    $type = $types[$count];
                    $product->product_type()->create(['type' => $type]);
                }

                Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added more product type', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);


            }

            if ($request->item === 'AddDespt') {

                $despts = $request->description;

                for($count = 0; $count<count($despts); $count++){
                    $despt = $despts[$count];
                    $product->product_despt()->create(['description' => $despt]);
                }

                Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Added more product description', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);


            }

            // dd('True'.$id);
        }
        else{

        // dd('Not true');

        $product = Product::findorfail($id);

        $product->update(
            $request->validate([

            'user_id' => ['required', 'numeric'],
            'product_name' => ['required', 'string', 'max:255', 'unique:products' . ($id ? ",id,$id" : ''), new CheckName($request->product_name)],
            'qty' => ['required', 'numeric'],
            'pcs_rft' => ['required', 'string'],
            // 'description' => ['required', 'string', new CheckAddress($request->description)],
            // 'type' => ['required', 'string', new CheckAddress($request->type)],

            ]));

        // $product = Product::create($validator);

        Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Updated product', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

        return redirect()->route('products.index')->with(['products'=> Product::where('deleted', 1)->paginate(10), 'success'=>'Product updated .....']);
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
        if ($request->item === 'Type' or $request->item === 'Despt') {

            if ($request->item === 'Type') {

                ProductType::destroy($id);

                Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted product type.', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

                return view('products.edit')->with(['products'=>Product::findorfail($request->id), 'descriptions'=>ProductDescription::where('product_id', $request->id)->paginate(5), 'types'=>ProductType::where('product_id', $request->id)->paginate(5)]);
            }

            if ($request->item === 'Despt') {

                ProductDescription::destroy($id);

                Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted product description.', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

                return view('products.edit')->with(['products'=>Product::findorfail($request->id), 'descriptions'=>ProductDescription::where('product_id', $request->id)->paginate(5), 'types'=>ProductType::where('product_id', $request->id)->paginate(5)]);
            }

        }

        else{

            Product::where('id', $id)->update(array('deleted'=> 0));

            Logs::create(['user_id'=>Auth::user()->id, 'action'=>'Deleted product.', 'ip_address'=>$request->ip(), 'os_browser_info'=>$request->userAgent()]);

            return redirect()->route('products.index')->with(['products'=> Product::where('deleted', 1)->paginate(10), 'success'=>'Product Deleted .....']);
        }

    }
}
