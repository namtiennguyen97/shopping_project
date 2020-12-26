<?php


namespace App\Models;


class Cart
{
    public $product = null;
    public $totalPrice = 0;
    public $totalQty = 0;
    public function __construct($cart)
    {
        if ($cart){

            $this->product = $cart->product;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQty = $cart->totalQty;
        }
    }

    public function addCart($product, $id){
        $newProduct = ['qty'=> 0, 'productInfo'=> $product, 'price'=> $product->price];
        if ($this->product){
            if (array_key_exists($id, $this->product)){
                $newProduct = $this->product[$id];

            }
        }
        $newProduct['qty']++;
        $newProduct['price'] = $newProduct['qty'] * $product->price;
        $this->product[$id] = $newProduct;
        $this->totalPrice += $product->price;
        $this->totalQty++;
    }

    public function deleteCart($id){
        $this->totalQty -= $this->product[$id]['qty'];
        $this->totalPrice -= $this->product[$id]['price'];
        unset($this->product[$id]);
    }

}
