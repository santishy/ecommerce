<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $products;
    public function __construct($order)
    {
        //
        $this->order=$order;
        $this->products=$order->shopping_cart->products()->get(); //checar
        //esta funcion paso a otro modelo "shoppingCart" y se manda llamar
        //como propiedad
    }
    public function build()
    {
        return $this->from('santiagomartinochoaestrada@gmail.com')
                ->view('mailers.order');
    }
}
