<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //
    public function pizzaList(Request $req){
        if($req->status=='desc'){
            $data = Products::orderBy('created_at','desc')->get();
        }
        else{
            $data = Products::orderBy('created_at','asc')->get();
        }
        return response()->json($data, 200);
    }

    #add to cart
    public function addToCart(Request $req){
        $data = $this->getOrderData($req);
        Cart::create($data);

        $response = [
            'message' => 'Item added to cart.',
            'status' => 'success'
        ];
        return response()->json($response, 200);
    }

    private function getOrderData($req){
        return [
            'user_id' => $req->userID,
            'product_id' => $req->pizzaID,
            'quantity' => $req->count
        ];
    }
}
