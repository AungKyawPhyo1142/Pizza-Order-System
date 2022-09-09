<?php

namespace App\Http\Controllers\User;

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
        return $data;
    }
}
