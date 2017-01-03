<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    //
    protected $fillable=['status'];/* Aqui van los campos que se les puede asignar
    al metodo, ShoppingCart::create($arreglo)*/
    public function generateCustomID()
    {
      return md5($this->id.' '.$this->updated_at);
    }
    public function updateCustomIdAndStatus()
    {
      $this->customid=$this->generateCustomID();
      $this->status="Aprovado";
      $this->save();
    }
    public function order()
    {
        return $this->hasOne('App\Order')->first();
    }
    public static function findOrCreateBySession($shopping_cart_id)
    {
      if($shopping_cart_id)
      //buscar el carrito de compras con esta sesion
        return ShoppingCart::findBySession($shopping_cart_id);
      else
        //crear un carrito de compras
        return ShoppingCart::createWithoutSession();
    }
    public static function findBySession($shopping_cart_id)
    {
      return ShoppingCart::find($shopping_cart_id);
    }
    public static function createWithoutSession()
    {
      return ShoppingCart::create(['status'=>'incompleted']);
    }
    public function in_shopping_carts(){
      return $this->hasMany('App\InShoppingCart');
    }
    public function products()
    {
      return $this->belongsToMany('App\Product','in_shopping_carts');
    }
    public function productsSize()
    {
      return $this->products()->count();
    }
    public function total()
    {
      return $this->products()->sum('princing');
    }
}
