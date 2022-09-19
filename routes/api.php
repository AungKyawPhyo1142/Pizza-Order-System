<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    GET: use to get the data from API
    -------------------------------------------------------------------------------------------------
    - API to get all the data: http://127.0.0.1:8000/api/all/list  (get)
    -------------------------------------------------------------------------------------------------

    - API to get all the products data: http://127.0.0.1:8000/api/product/list  (get)

    - API to get all the categories data: http://127.0.0.1:8000/api/category/list  (get)

    - API to get all the user data: http://127.0.0.1:8000/api/user/list  (get)

    - API to get all the order data: http://127.0.0.1:8000/api/order/list  (get)

    - API to get all the feedbacks data: http://127.0.0.1:8000/api/feedbacks/list  (get)

    -------------------------------------------------------------------------------------------------

*/

// get all products data
Route::get('product/list',[RouteController::class,'getProductData']);

// get all category data
Route::get('category/list',[RouteController::class,'getCategoryData']);

// get all user data
Route::get('user/list',[RouteController::class,'getUserData']);

// get all order data
Route::get('order/list',[RouteController::class,'getOrderData']);

// get all user feedbacks data
Route::get('feedbacks/list',[RouteController::class,'getFeedbackData']);

// get all the data
Route::get('all/list',[RouteController::class,'getAllData']);

/*
    POST: use to send the data from API
    -------------------------------------------------------------------------------------------------
    -------------------------------------------------------------------------------------------------

    - API to insert category data: http://127.0.0.1:8000/api/create/category  (post)

    - API to insert feedback data: http://127.0.0.1:8000/api/create/feedback  (post)

    -------------------------------------------------------------------------------------------------

*/

// insert a new category
Route::post('create/category',[RouteController::class,'createCategory']);

// insert a new feedback
Route::post('create/feedback',[RouteController::class,'createFeedback']);

// delete category
Route::post('delete/category',[RouteController::class,'deleteCategory']);
