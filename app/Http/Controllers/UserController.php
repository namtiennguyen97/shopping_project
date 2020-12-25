<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateUser(Request $request, $id)
    {
//        User::find($id)->update($request->all());
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->full_name = $request->input('full_name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();
        return $user;
    }

    public function updatePassword(Request $request, $id){
//        $currentPassword = Auth::user()->getAuthPassword();

        $validatedData = $request->validate([
            'newPassword' => 'required|min:8',
            'confirmNewPassword' => 'required|same:newPassword'
        ]);

//        $request->validate([
//            'newPassword' => 'required|min:8',
//            'confirmNewPassword' => 'required|same:newPassword'
//        ]);
//        $this->validate($request, [
//                        'newPassword' => 'required|min:8',
//            'confirmNewPassword' => 'required|same:newPassword'
//        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->input('confirmNewPassword'));
        $user->save();
        return $validatedData;
    }

}
