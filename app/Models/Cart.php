<?php


namespace App\Models;


class Cart
{
    public $product = null;
    public $totalPrice = 0;
    public $totalQty = 0;

    public function __construct($cart)
    {
        $this->product = $cart->product;
        $this->totalPrice = $cart->totalPrice;
        $this->totalQty = $cart->totalQty;
    }
    public function addToCart($item, $id){

    }
}
