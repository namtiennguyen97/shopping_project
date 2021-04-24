<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePassword;
use App\Http\Service\userServiceImplement\UserServiceImplement;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServiceImplement $userServiceImplement)
    {
        $this->userService = $userServiceImplement;
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'min:3|max:15|required',
            'full_name' => 'min:6|max:20|required',
            'phone' => 'numeric|required',
            'address' => 'required|max:40'
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->full_name = $request->input('full_name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();
        return $user;
    }


//    public function IDChangePassword($id){
//       $userID =  User::findOrFail($id);
//        return view('dashboard', compact('userID'));
//    }
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'currentPassword' => 'required|password|min:8|max:25',
            'newPassword' => 'required|min:8|max:25',
            'confirmNewPassword' => 'required|same:newPassword|min:8|max:25'
        ]);
        $user = User::find($id);
        $user->password = Hash::make($request->input('confirmNewPassword'));
        $user->save();
        return $request;

    }

    public function addCart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($this->userCan('view-page-guest')) {
            if ($product != null) {
                $oldCart = Session('Cart') ? Session('Cart') : null;
                $newCart = new Cart($oldCart);
                $newCart->addCart($product, $id);
                $request->session()->put('Cart', $newCart);
            }
            return view('shoppingCart.cart-list');
        }
        return redirect()->route('login');
    }

    public function deleteItemCart(Request $request, $id)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteCart($id);
        if (count($newCart->product) > 0) {
            $request->session()->put('Cart', $newCart);
        } else {
            $request->session()->forget('Cart');
        }

        return view('shoppingCart.cart-list');
    }



    //upload Avatar
    public function storeUserAvatar(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->hasFile('userImage')) {
            //xoa anh cu neu co
            $currentImage = $user->image;
            if ($currentImage) {
                Storage::delete('/public/'. $currentImage);
            }
            $image1 = $request->file('userImage');
            $path = $image1->store('images', 'public');
            $user->image = $path;
        }
        $user->save();
        return response()->json([
            'requested_image' => '<a><img src="storage/' . $user->image . '" class="img-thumbnail user-avatar" width="40" alt="image" /></a>',
            'dashboard_image' => '<img src="storage/' . $user->image . '" class="img-thumbnail avatar-dashboard" width="40" alt="image" />',
            'comment_image' => '<img src="storage/' . $user->image . '" class="img-thumbnail avatar-comment" width="40" alt="image" />'
        ]);
    }

    public function userDashboard(){
        if (\session()->has('logged')){
            $user = User::where('id','=',\session('logged'))->first();
            return view();
        }

    }








}
