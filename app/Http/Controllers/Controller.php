<?php

namespace App\Http\Controllers;

use App\Http\UserFacade;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userCan($action, $option = null)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    public function index()
    {
        if ($this->userCan('view-page-admin')){
            return redirect()->route('admin.index');
        }
        return redirect()->route( url('/dashboard') );
    }



    public function showPageGuest(){
        if (!$this->userCan('view-page-guest')){
            abort('403',__('You re not enough authorize to access this website'));

        }
        return view('dashboard');
    }
    public function showPageAdmin(){
        if (UserFacade::getUser()->role_id == 2){
//            abort('403',__('You re not enough authorize to access this website'));
            return view('admin.index');

        }
        return redirect()->route('index');
    }

    public function mainIndex(){
        $user = User::where('id','=',session('logged'))->first();
        return view('index', compact('user'));
    }

}
