<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateUser(Request $request, $id)
    {
        User::find($id)->update($request->all());
    }

    public function updatePassword(Request $request, $id){
        $currentPassword = Auth::user()->getAuthPassword();
        $password = $request->input('password');
    }
}
