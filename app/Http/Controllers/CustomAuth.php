<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuth extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:15|min:3',
            'full_name' => 'required|max:30|min:3',
            'phone' => 'required|numeric',
            'email' => 'required|unique:users|email|max:40|min:9',
            'address' => 'required|max:50|min:2',
            'role_id' => 'required',
            'password' => 'required|max:25|min:8',
            'rePassword' => 'required|same:password'
//            'image' => 'required|mimes:jpg,png,gif',
        ]);
        $user = User::create([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['Success','Your account has been created!'.$user],200);
    }

    public function userLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email','=',$request->email)->first();
        if ($user){
            if (Hash::check($request->password,$user->password)){
                session()->put('logged',$user->id);
                return redirect()->route('index');
            } else{
                return response()->json(['errorLogin','Something went wrong! Pls check again'],400);
            }
        } else{
            return response()->json(['ErrorLogin','No user match'],400);
        }
    }

    public function logout(){
        if (session()->has('logged')){
            session()->pull('logged');
            return redirect()->route('index');
        }
    }

    public function userDashboard(){
        if (\session()->has('logged')){
           $user = User::find(session('logged'));

        }
        return view('dashboard', compact('user'));
    }

    //navbar auth

}


