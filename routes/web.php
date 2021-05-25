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

Route::get('/',[\App\Http\Controllers\Controller::class,'mainIndex'])->name('index');
Route::get('/home', [\App\Http\Controllers\Controller::class,'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/guest', function (){
return view('guest');
})->name('guest.index');

//Route::get('/admin',function (){
//    return view('admin');
//})->name('admin.index');





Route::post('/updateUser/{id}',[\App\Http\Controllers\UserController::class,'updateUser'])->name('update.user');

Route::post('/updatePassword/{id}',[\App\Http\Controllers\UserController::class,'updatePassword'])->name('update.password');

Route::get('/addCart/{id}',[\App\Http\Controllers\UserController::class,'addCart'])->name('user.addCart')->middleware('checkCustomAuth');
Route::get('/deleteCart/{id}', [\App\Http\Controllers\UserController::class, 'deleteItemCart'])->name('product.deleteItemCart')->middleware('checkCustomAuth');
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
//show user modal profile in footer
Route::get('showUserProfile/{id}',[\App\Http\Controllers\UserController::class,'showUserProfile'])->name('show.user.profile');


//Admin blade
Route::group(['namespace'=>'Admin'],function (){
    Route::get('/page-guest',[\App\Http\Controllers\Controller::class,'showPageGuest']);
    Route::get('/admin',[\App\Http\Controllers\Controller::class,'showPageAdmin'])->name('admin.index')->middleware('loginCheck');
    Route::get('/userManager',[\App\Http\Controllers\Admin\AdminController::class,'userManager'])->name('admin.user');
    Route::get('/userRender',[\App\Http\Controllers\Admin\AdminController::class,'renderUser'])->name('render.user');
    Route::get('/deleteUser/{id}',[\App\Http\Controllers\Admin\AdminController::class,'deleteUser'])->name('admin.delete.user');
    Route::post('/updateUser/{id}',[\App\Http\Controllers\Admin\AdminController::class,'editUser'])->name('admin.edit.user');
    Route::post('/storeProduct',[\App\Http\Controllers\Admin\AdminController::class,'storeProduction'])->name('admin.store.product')->middleware('adminCheck');
    Route::get('/adminProduct',[\App\Http\Controllers\Admin\AdminController::class,'productIndex'])->name('admin.product.index');
    //delete product
    Route::get('deleteProduct/{id}',[\App\Http\Controllers\Admin\AdminController::class,'deleteProduct'])->name('admin.delete.product');
    //cate render
    Route::get('/category-render',[\App\Http\Controllers\Admin\AdminController::class,'renderCategory'])->name('admin.category.render');
});

//
//Route::get('/',[\App\Http\Controllers\ProductController::class,'productIndex']);
Route::post('/createProduct',[\App\Http\Controllers\ProductController::class,'createProductAdmin']);

//custom Auth
Route::post('/userRegister',[\App\Http\Controllers\CustomAuth::class,'register'])->name('custom.register');
Route::post('/userLogin',[\App\Http\Controllers\CustomAuth::class,'userLogin'])->name('custom.login');
Route::post('/userLogout',[\App\Http\Controllers\CustomAuth::class,'logout'])->name('custom.logout');

Route::get('/userDashboard',[\App\Http\Controllers\CustomAuth::class,'userDashboard'])->name('custom.user.dashboard')->middleware('loginCheck');

//showDetail product with view count + 1
Route::get('/showDetail/{id}',[\App\Http\Controllers\ProductController::class,'showDetailProduct'])->name('product.detail.show');
// make purchase and send mail
Route::get('/mail/one/{id}',[\App\Http\Controllers\ProductController::class,'purchase'])->name('purchase.one.mail');
Route::get('/product/show/{id}',[\App\Http\Controllers\ProductController::class,'show'])->name('product.show');


Route::get('/yourCart',[\App\Http\Controllers\ProductController::class,'viewCart'])->name('cart.view')->middleware('loginCheck');
//show all product tai trang san pham
Route::get('/product',[\App\Http\Controllers\ProductController::class,'productViewAll'])->name('product.view.all');
Route::get('/product/searching',[\App\Http\Controllers\ProductController::class,'productSearching'])->name('product.searching');
