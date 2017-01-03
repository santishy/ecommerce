<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }
    public function index()
    {
        $products= Product::all();
        return view('products.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product=new Product;
        return view('products.create',['product'=>$product]);
    }

    public function image($nameFile)
    {
        $path= storage_path('app/images/'.$nameFile);
        if(!\File::exists($path)) abort(404);
        $file=\File::get($path); //leemos el archivo
        $mimeType=\File::mimeType($path);
        $response=\Response::make($file,200); //
        $response->header('Content-Type',$mimeType);
        return $response;
    }
    public function store(Request $request)
    {
        //
        $product = new Product();
        $hasFile=$request->hasFile('cover') && $request->cover->isValid();
        if($hasFile)
        {
            $extension=$request->cover->extension();
            $product->extension=$extension;
        }
        $product->title=$request->title;
        $product->description=$request->description;
        $product->princing=$request->princing;
        $product->user_id=Auth::user()->id;
        if($product->save())
        {
            if($hasFile)
            {
                $request->cover->storeAs('images',$product->id.'.'.$extension);

            }
          return redirect('/products');
        }
        else {
          return view('products.create',['product'=>$product]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product=Product::find($id);
      return view('products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product= Product::find($id) ;
      return view('products.edit',['product'=>$product]);
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
        $product = Product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->princing=$request->princing;
        //$product->user_id=Auth::user()->id;
        if($product->save())
        {
          return redirect('/products');
        }
        else {
          return view('products.edit',['product'=>$product]);
        }
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
        Product::destroy($id);
        return redirect('/products');
    }
}
