<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\InShoppingCart;

class InShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
      $this->middleware('shoppingcart');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shopping_cart=$request->shopping_cart;
        $response=InShoppingCart::create(['product_id'=>$request->product_id,
        'shopping_cart_id'=>$shopping_cart->id]);
        if($request->ajax())
        {
            return response()->json(['products_count'=>InShoppingCart::productsCount($shopping_cart->id)]);
        }
        if(false)
        {
          return redirect('/carrito');
        }
        else {
          return back();
        }
    }

    public function destroy($id)
    {
        //
    }
}
