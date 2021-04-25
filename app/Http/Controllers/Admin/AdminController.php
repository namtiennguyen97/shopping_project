<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Service\productServiceImplement\ProductServiceImplement;
use App\Http\UserFacade;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected $productService;
    public function __construct(ProductServiceImplement $productServiceImplement)
    {
        $this->productService = $productServiceImplement;
    }

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
    //render category
    public function renderCategory(){
        $cate = Product::all();
        return $cate;
    }

//admin show User manager template
    public function userManager(){
        if (UserFacade::getUser()->role_id == 2){
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

           $user = User::find($id);
            $user->name = $request->input('name');
            $user->full_name = $request->input('full_name');
            $user->address = $request->input('address');
            $user->phone = $request->input('phone');
            $user->role_id = $request->input('role_id');
            $user->save();
            return $user;

    }

    //Product controller
    public function productIndex(){
        return view('admin.permisson.productManager');
    }
//create product in admin page
    public function storeProduction(Request $request){

        if ($request->hasFile('image')){
            $image1 = $request->file('image');
            $path = $image1->store('images','public');
            $previewImage1 = $request->file('previewImage1');
            $path2 = $previewImage1->store('images','public');
            $previewImage2 = $request->file('previewImage2');
            $path3 = $previewImage2->store('images','public');

            $newProduct = $this->productService->create([
                'name' => $request->name,
                'price' => $request->price,
                'vendor' => $request->vendor,
                'desc' => $request->desc,
                'category_id' => $request->category_id,
                'image' => $path,
                'previewImage1' => $path2,
                'previewImage2' =>$path3
            ]);
            return response()->json($newProduct);
        }


    }

    // delete product
    public function deleteProduct($id){
        $product = Product::find($id);
        $currentImage = $product->image;
        if ($currentImage){
            Storage::delete('/public/'. $currentImage);
        }
        $product->delete();
        return redirect()->route('admin.product.index');
    }

    //update Product
    public function updateProduct(Request $request, $id){
        $product = Product::find($id);


    }
}
