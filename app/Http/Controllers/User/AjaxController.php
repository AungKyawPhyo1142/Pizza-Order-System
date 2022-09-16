<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Products;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    #order
    public function order(Request $req){

        $total=0;

        foreach($req->all() as $item){
            $data = OrderList::create([
                        'user_id'=>$item['user_id'],
                        'product_id'=>$item['product_id'],
                        'qty'=> $item['qty'],
                        'total' => $item['total'],
                        'order_code'=> $item['order_code']
                    ]);
            $total+= $data->total;
        }


        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code'=> ''.$data->order_code,
            'total_price'=> $total+3000
        ]);

        $response = [
            'status' => true,
            'message' => 'Order Complete'
        ];
        return response()->json($response, 200);
    }

    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    public function clearCurrentProduct(Request $req){
        Cart::where('user_id',Auth::user()->id)
              -> where('product_id',$req->product_id)
              -> where('id',$req->order_id)
              -> delete();
    }

    private function getOrderData($req){
        return [
            'user_id' => $req->userID,
            'product_id' => $req->pizzaID,
            'quantity' => $req->count
        ];
    }
}
