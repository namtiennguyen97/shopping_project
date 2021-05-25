<?php

namespace App\Http\Controllers;

use App\Http\Service\productServiceImplement\ProductServiceImplement;
use App\Http\UserFacade;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceImplement $productServiceImplement)
    {
        $this->productService = $productServiceImplement;
    }

    public function addCart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product, $id);
            $request->session()->put('Cart', $newCart);
        }
        return view('shoppingCart.cart-list');
    }

    public function productIndex()
    {
        $product = $this->productService->index();

        return view('index', compact('product'));
    }

    public function createProductAdmin(Request $request)
    {
        $rules = $request->validate([
            'name' => 'required|max:50|min:2',
            'price' => 'required|numeric',
            'vendor' => 'required|max:25',
            'image' => 'required|mimes:jpg,gif,png',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image1 = $request->file('image');
            $path = $image1->store('image/', 'public');
            $newProduct = $this->productService->create([
                'name' => $request->name,
                'price' => $request->price,
                'vendor' => $request->vendor,
                'image' => $path,
                'desc' => $request->desc,
                'category_id' => $request->category_id
            ]);
            return $newProduct;
        }
    }

    //show detail product with viewcount + 1
    public function showDetailProduct($id)
    {
        $productKey = 'product_' . $id;
        if (!session()->has($productKey)) {
            Product::where('id', $id)->increment('view_count');
            session()->put($productKey);
        }
        $product = Product::find($id);
        return view('shoppingCart.detailProduct', compact('product'));
    }


    //purchase
    public function purchase($id)
    {
        if (\session()->has('logged')) {
            $product = Product::findOrFail($id);
            Mail::send('mail.purchaseOne', [
                'name' => $product->name,
                'price' => $product->price,
                'desc' => $product->desc,
                'userPhone' => UserFacade::getUser()->phone
            ], function ($mail) {
                $mail->to(UserFacade::getUser()->email, 'N store');
                $mail->from('toilanam97@gmail.com');
                $mail->subject('Thank for purchasing!');
            });
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

// show all cart product
    public function viewCart()
    {
        return view('shoppingCart.cart');
    }

    //make total Purchase
    public function allPurchase(){

    }

    public function productViewAll(){
        return view('products.index');
    }

    // search product index
    public function productSearching(Request $request){

        if ($request->ajax()){
            $html = '';
            $query = $request->get('query');
            if ($query != ''){
                $productQuery = Product::where('name','like','%'.$query.'%')->get();
                    foreach ($productQuery as $value){
                        $html .= "<div class='col-md-4'>
                            <div class='product-item'>
                            <div class='product-title'>
                                <a>".$value->name."</a>
                                <div class='ratting'>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                </div>
                            </div>
                            <div class='product-image'>
                                <a href=''>
                                    <img src='storage/".$value->image."' alt='Product Image'>
                                </a>
                                <div class='product-action'>
                                    <a href='javascript:'><i class='fa fa-cart-plus' onclick='addCart(".$value->id.")'></i></a>
                                    <a href=''><i class='fa fa-heart'></i></a>
                                    <a href='javascript:'><i class='fa fa-search'></i></a>
                                </div>
                            </div>
                            <div class='product-price'>
                                <h3><span>$</span>".$value->price."</h3>
                                <a class='btn btn-purchase-now' data-id='".$value->id."'><i class='fa fa-shopping-cart'></i>Buy Now</a>
                            </div>
                        </div>
                        </div>";
                }
            } else{
                $productQuery = Product::all();
                foreach ($productQuery as $value){

                    $html .= "<div class='col-md-4'>
                            <div class='product-item'>
                            <div class='product-title'>
                                <a>".$value->name."</a>
                                <div class='ratting'>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                    <i class='fa fa-star'></i>
                                </div>
                            </div>
                            <div class='product-image'>
                                <a href=''>
                                    <img src='storage/".$value->image."' alt='Product Image'>
                                </a>
                                <div class='product-action'>
                                    <a href='javascript:'><i class='fa fa-cart-plus' onclick='addCart(".$value->id.")'></i></a>
                                    <a href=''><i class='fa fa-heart'></i></a>
                                    <a href='javascript:'><i class='fa fa-search'></i></a>
                                </div>
                            </div>
                            <div class='product-price'>
                                <h3><span>$</span>".$value->price."</h3>
                                <a class='btn btn-purchase-now' data-id='".$value->id."'><i class='fa fa-shopping-cart'></i>Buy Now</a>
                            </div>
                        </div>
                        </div>";
                }
            }
        }


        $productData = [
          'data' => $html
        ];
        echo json_encode($productData);
    }

}

