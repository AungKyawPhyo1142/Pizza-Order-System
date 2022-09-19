<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all products data
    public function getProductData(){
        $products = Products::get();
        return response()->json($products, 200);
    }

    // get all category data
    public function getCategoryData(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    // get all user data
    public function getUserData(){
        $user = User::get();
        return response()->json($user, 200);
    }

    // get all order lists data
    public function getOrderData(){
        $order = Order::get();
        return response()->json($order, 200);
    }

    // get all feedbacks
    public function getFeedbackData(){
        $feedbacks = Contact::get();
        return response()->json($feedbacks, 200);
    }

    // get all data
    public function getAllData(){

        $products = Products::get();
        $category = Category::get();
        $user = User::get();
        $order = Order::get();
        $feedbacks = Contact::get();

        $data = [
            'products' => $products,
            'category' => $category,
            'user' => $user,
            'order' => $order,
            'feedbacks' => $feedbacks
        ];

        return response()->json($data, 200);
    }
}
