<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePassword;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'currentPassword' => 'required|password|min:8|max:25',
            'newPassword' => 'required|min:8|max:25',
            'confirmNewPassword' => 'required|same:newPassword|min:8|max:25'
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
    public function updatePassword(Request $request, $id){
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

    public function addCart(Request $request, $id){
        $product = Product::find($id);
        if ($this->userCan('view-page-guest')){
            if ($product != null){
                $oldCart = Session('Cart') ? Session('Cart') : null;
                $newCart = new Cart($oldCart);
                $newCart->addCart($product, $id);
                $request->session()->put('Cart', $newCart);
            }
            return view('shoppingCart.cart-list');
        }
        return redirect()->route('login');
    }

}
