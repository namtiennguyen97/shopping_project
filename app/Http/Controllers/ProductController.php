<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function addCart(Request $request,$id){
        $product = Product::find($id);
        if ($product != null){
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product, $id);
            $request->session()->put('Cart', $newCart);
        }
        return view('shoppingCart.cart-list');
    }


}
