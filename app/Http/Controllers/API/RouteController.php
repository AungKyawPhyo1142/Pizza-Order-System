<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
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

    // insert new categories
    public function createCategory(Request $req){
        // use dd($req->all()) to print out the data which was sent inside the BODY of an API
        // use dd($req->header('headerData')) to print out the data which was sent inside the HEADER of an API
        $data = [
            'name' => $req->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);

        return response()->json($response, 200);
    }

    // insert a new feedback
    public function createFeedback(Request $req){
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'message' => $req->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Contact::create($data);
        return response()->json($response, 200);
    }


    // delete category
    public function deleteCategory(Request $req){

        $data = Category::where('id',$req->category_id)->first();

        if (isset($data)){
            Category::where('id',$req->category_id)->delete();
            return response()->json(['status'=>true,'message'=>'Data deleted successfully'], 200);
        }

        return response()->json(['status'=>false,'message'=>'Data deleted successfully'], 200);
    }

    // details category
    public function detailsCategory($id){

        $data = Category::where('id',$id)->first();

        if (isset($data)){
            return response()->json(['status'=>true,'category'=>$data], 200);
        }
        return response()->json(['status'=>false,'category'=>"There is no category"], 500);

    }

    public function updateCategory(Request $req){

        $category_id = $req->category_id;
        $db = Category::where('id',$category_id)->first();
        if(isset($db)){
            $data = $this->getCatData($req);
            Category::where('id',$category_id)->update($data);
            return response()->json(['status'=>true,'message'=>'update success'], 200);
        }

        return response()->json(['status'=>false,'message'=>'There is no category to update'], 500);
    }

    private function getCatData($req){

        return [
            'name' => $req->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
