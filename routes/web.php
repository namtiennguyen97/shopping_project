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





Route::post('/updateUser/{id}',[\App\Http\Controllers\UserController::class,'updateUser'])->name('update.user');
Route::post('/updatePassword/{id}',[\App\Http\Controllers\UserController::class,'updatePassword'])->name('update.password');
Route::get('/addCart/{id}',[\App\Http\Controllers\UserController::class,'addCart'])->name('user.addCart');
Route::get('/deleteCart/{id}', [\App\Http\Controllers\UserController::class, 'deleteItemCart'])->name('product.deleteItemCart');
Route::get('/post/',[\App\Http\Controllers\PostController::class,'showPost'])->name('post.index');
Route::post('/post/create',[\App\Http\Controllers\PostController::class,'addPost'])->name('post.create');
Route::get('/post/destroy/{id}',[\App\Http\Controllers\PostController::class,'destroy'])->name('post.destroy');
Route::post('/post/update/{id}',[\App\Http\Controllers\PostController::class,'updatePost'])->name('post.update');
Route::get('/showOnePost/{id}',[\App\Http\Controllers\PostController::class,'showOnePost'])->name('showPost');

//Route::get('/dashboard',[\App\Http\Controllers\UserController::class,'IDChangePassword'])->name('id_user');

//Admin blade
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('/page-guest',[\App\Http\Controllers\Controller::class,'showPageGuest']);
    Route::get('/',[\App\Http\Controllers\Controller::class,'showPageAdmin'])->name('admin.index');
    Route::get('/userManager',[\App\Http\Controllers\Admin\AdminController::class,'userManager'])->name('admin.user');
    Route::get('/userRender',[\App\Http\Controllers\Admin\AdminController::class,'renderUser'])->name('render.user');
    Route::get('/deleteUser/{id}',[\App\Http\Controllers\Admin\AdminController::class,'deleteUser'])->name('admin.delete.user');
    Route::post('/updateUser/{id}',[\App\Http\Controllers\Admin\AdminController::class,'editUser'])->name('admin.edit.user');
    Route::post('/storeProduct',[\App\Http\Controllers\Admin\AdminController::class,'storeProduction'])->name('admin.store.product');
    Route::get('/adminProduct',[\App\Http\Controllers\Admin\AdminController::class,'productIndex'])->name('admin.product.index');
});


