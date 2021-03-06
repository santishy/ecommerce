<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;
class ShoppingCartsController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('shoppingcart');
    }
    public function index(Request $request)
    {
      $shopping_cart=$request->shopping_cart;
      /*$PayPal=new PayPal($shopping_cart);
      $payment=$PayPal->generete();
      return redirect($payment->getApprovalLink());*/
      $products=$shopping_cart->products()->get();
      $total=$shopping_cart->total();
      return view('in_shopping_carts.index',['products'=>$products,'total'=>$total]);
    }
    public function checkout(Request $request)
    {
        $shopping_cart=$request->shopping_cart;
        $PayPal=new PayPal($shopping_cart);
        $payment=$PayPal->generete();
        return redirect($payment->getApprovalLink());
    }
    public static function show($id)
    {
        $shopping_cart= ShoppingCart::where('customid',$id)->first();
        $order=$shopping_cart->order();
        return view('in_shopping_carts.completed',['shopping_cart'=>$shopping_cart,'order'=>$order]);
    }
}
