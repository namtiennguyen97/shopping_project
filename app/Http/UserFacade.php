<?php


namespace App\Http;


use App\Models\User;


class UserFacade
{

    static public function getUser(){
        if (session()->has('logged')){
            $user = \App\Models\User::where('id','=',session('logged'))->first();
           return $user;

        }
    }

    static public function sayHello(){
        echo 'Hello';
    }
}
