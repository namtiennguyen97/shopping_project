<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/home', [\App\Http\Controllers\Controller::class,'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/guest', function (){
return view('guest');
})->name('guest.index');

Route::get('/admin',function (){
    return view('admin');
})->name('admin.index');



Route::get('/page-guest',[\App\Http\Controllers\Controller::class,'showPageGuest']);
Route::get('/page-admin',[\App\Http\Controllers\Controller::class,'showPageAdmin']);

Route::post('/updateUser/{id}',[\App\Http\Controllers\UserController::class,'updateUser'])->name('update.user');
