<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function storeProduct(Request $request)
    {

    }

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

    public function userManager(){
        return view('admin.permisson.userManager');
    }

    public function deleteUser($id){
        User::destroy($id);
    }

    public function editUser(Request $request, $id){
        User::find($id)->update($request->all());

    }
}
