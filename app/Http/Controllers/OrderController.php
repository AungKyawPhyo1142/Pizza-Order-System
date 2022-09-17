<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){
        $order = Order::select('orders.*','users.name as username')
                ->leftJoin('users','users.id','user_id')
                ->orderBy('created_at','desc')
                ->paginate(5);
        return view('admin.order.list',compact('order'));
    }

    public function sortStatus(Request $req){

        $order = Order::select('orders.*','users.name as username')
                ->leftJoin('users','users.id','user_id')
                ->orderBy('created_at','desc');

        // if status is null, do this query
        if($req->status == null){
            $order = $order->get();
        }
        // if not, do this query
        else{
            $order = $order->where('orders.status',$req->status)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    public function changeStatus(Request $req){
        Order::where('id',$req->order_id)->update([
            'status'=> $req->status,
            'updated_at' => Carbon::now()
        ]);
    }

    public function orderInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();

        $orderInfo = OrderList::select('order_lists.*','users.name as username','products.image as product_image','products.name as product_name')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)
                    ->get();
        return view('admin.order.orderInfo',compact('orderInfo','order'));
    }

}
