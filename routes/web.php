<?php

use App\Models\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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

Route::middleware(['admin_auth'])->group(function(){
    // login & register
    Route::redirect('/', 'loginPage');  // go to login(route) if / comes in URL
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


// we write Routes inside the middleware, if we only want someone to go to these routes, only after they login
Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    /* -------------------- ADMIN -------------------- */
    Route::middleware(['admin_auth'])->group(function () {

        // category
        Route::group(['prefix'=> 'category'],function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('editPage/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        // admin account
        Route::prefix('admin')->group(function () {
            // password
            Route::get('password/changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/Password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // account
            Route::get('account/details',[AdminController::class,'accountDetails'])->name('admin#accountDetails');
            Route::get('account/editPage',[AdminController::class,'accountEditPage'])->name('admin#accountEditPage');
            Route::post('account/update/{id}',[AdminController::class,'updateAccountData'])->name('admin#updateAccountData');

            // admin list
            Route::get('adminList',[AdminController::class,'showAdminList'])->name('admin#showAdminList');
            Route::get('deleteAdmin/{id}',[AdminController::class,'deleteAdmin'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
            Route::get('ajax/changeRole',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxChangeRole');
        });

        // products
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductsController::class,'showList'])->name('product#showList');
            Route::get('createPage',[ProductsController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductsController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductsController::class,'delete'])->name('product#delete');
            Route::get('details/{id}',[ProductsController::class,'details'])->name('product#details');
            Route::get('editPage/{id}',[ProductsController::class,'editPage'])->name('product#editPage');
            Route::post('edit',[ProductsController::class,'edit'])->name('product#edit');

        });

        // order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('ajax/status',[OrderController::class,'sortStatus'])->name('admin#sortStatus');
            Route::get('ajax/change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
        });

    });


    /* --------------------  USER  -------------------- */
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){

        Route::get('/home',[UserController::class,'homePage'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');

        // pizza
        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });

        // cart
        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        });

        // password
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
        });

        // account
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/currentProduct',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
        });

    });


});


