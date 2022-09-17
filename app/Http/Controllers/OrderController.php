<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
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
        return response()->json($order, 200);
    }

    public function changeStatus(Request $req){
        logger($req->all());
        Order::where('id',$req->order_id)->update([
            'status'=> $req->status,
            'updated_at' => Carbon::now()
        ]);
    }

}
