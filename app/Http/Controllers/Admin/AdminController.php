<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

// render user in admin
    public function renderUser(){
        $user = User::all();
        $output = '';
        if (count($user)> 0){
            foreach ($user as $row){
                $output .= "<tr>
<td>$row->name</td>
<td>$row->full_name</td>
<td>$row->phone</td>
<td>$row->email</td>
<td>$row->address</td>
<td>{$row->userRole->name}</td>
<td><a class='btn btn-danger'><i data-id='$row->id' class=\"fas fa-trash-alt deleteUser\"></i></a></td>
<td><a class='btn btn-info'><i data-id='$row->id' data-name='$row->name' data-full_name='$row->full_name' data-phone='$row->phone' data-address='$row->address' data-email='$row->email' class=\"fas fa-user-edit editUser \"></i></a></td>
</tr>";
            }
        }
        else{
            $output = "<h2>No data found</h2>";
        }
        $arrayData = [
          'data_table' => $output
        ];
        echo json_encode($arrayData);
    }
//admin show User manager template
    public function userManager(){
        if ($this->userCan('view-page-admin')){
            return view('admin.permisson.userManager');
        }
        return redirect()->route('index');
    }
//deleteUser
    public function deleteUser($id){
        if ($this->userCan('view-page-admin')){
            User::destroy($id);
        }

    }

    // edit User
    public function editUser(Request $request, $id){
        if ($this->userCan('view-page-admin')){
           $user = User::find($id);
            $user->name = $request->input('name');
            $user->full_name = $request->input('full_name');
            $user->address = $request->input('address');
            $user->phone = $request->input('phone');
            $user->role_id = $request->input('role_id');
            $user->save();
            return $user;
        }
    }

    //Product controller
    public function productIndex(){
        return view('admin.permisson.productManager');
    }

    public function storeProduction(Request $request){
        $product = new Product();
        $product->name = $request->input('name');
        $product->vendor = $request->input('vendor');
        $product->price = $request->input('price');
        if ($request->hasFile('image')){
            $image1 = $request->file('image');
            $path = $image1->store('images','public');
            $product->image = $path;
        }
        $product->desc = $request->input('desc');
        $product->category_id = $request->input('category_id');
        $product->save();
//        return $product;
        return redirect()->route('admin.product.index');

    }
}
