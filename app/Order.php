<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use App\Mail\OrderCreated;
use App\Mail\OrderUpdated;
use Illuminate\Support\Facades\Mail;
class Order extends Model
{
    //
    
    protected $fillable=['recipient_name','line1','line2','city','country_code','state','postal_code',
      'email','shopping_cart_id','status','total','guide_number'];

    public function sendMail()
    {
        Mail::to('santiagomartinochoaestrada@gmail.com')->send(new OrderCreated($this));
    }
    public function sendUpdateMail()
    {
        Mail::to('santiagomartinochoaestrada@gmail.com')->send(new OrderUpdated($this));
    }
    public static function createFormPayPalResponse($response,$shopping_cart)
    {
    	$payer=$response->payer;
    	$orderData=(array) $payer->payer_info->shipping_address;
        //dd($orderData);
        $orderData=$orderData[key($orderData)];//se salta el arr['datos']['matriz']; arr['matriz']
    	$orderData['total']=$shopping_cart->total();
    	$orderData['email']=$payer->payer_info->email;
    	$orderData['shopping_cart_id']=$shopping_cart->id;
    	return Order::create($orderData);
    }
    public function shopping_cart()
    {
        return $this->belongsTo('App\ShoppingCart');
    }
    public function shoppingCartID()
    {
        return $this->shopping_cart->customid;
    }
    public function address()
    {
        return $this->line1.' '.$this->line2;
    }
    public function scopeLatest($query)
    {
        return $query->orderID()->monthly();
    }
    public function scopeOrderID($query)
    {
        return $query->orderBy('id','desc');
    }
    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at','=',date('m'));
    }
    public static function totalMonth(){
        return Order::monthly()->sum('total');
    }
    public static function totalMonthCount(){
        return Order::monthly()->count();
    }

}
