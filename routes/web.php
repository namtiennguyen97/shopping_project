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
// foreach data all comment
Route::get('/post/',[\App\Http\Controllers\PostController::class,'showPost'])->name('post.index');
// create new comment
Route::post('/post/create',[\App\Http\Controllers\PostController::class,'addPost'])->name('post.create');
// delete comment that user dont need
Route::get('/post/destroy/{id}',[\App\Http\Controllers\PostController::class,'destroy'])->name('post.destroy');
// update comment user
Route::post('/post/update/{id}',[\App\Http\Controllers\PostController::class,'updatePost'])->name('post.update');
//show one comment that can edit or something
Route::get('/showOnePost/{id}',[\App\Http\Controllers\PostController::class,'showOnePost'])->name('showPost');
//update user avatar at dashboard
Route::post('/updateUserAvatar/{id}',[\App\Http\Controllers\UserController::class,'storeUserAvatar'])->name('user.update.avatar');
//show user profile
Route::get('showUserProfile/{id}',[\App\Http\Controllers\UserController::class,'showUserProfile'])->name('show.user.profile');


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
    //delete product
    Route::get('deleteProduct/{id}',[\App\Http\Controllers\Admin\AdminController::class,'deleteProduct'])->name('admin.delete.product');
    //cate render
    Route::get('/category-render',[\App\Http\Controllers\Admin\AdminController::class,'renderCategory'])->name('admin.category.render');
});


