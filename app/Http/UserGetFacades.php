<?php


namespace App\Http;


use Illuminate\Support\Facades\Facade;

class UserGetFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userFacade';
    }
}
