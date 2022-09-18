<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // show user list
    public function showUserList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    public function changeUserRole(Request $req){
        $updateSource = [
            'role'=> $req->role,
            'updated_at' => Carbon::now()
        ];
        $data = User::where('id',$req->user_id)->update($updateSource);
        return response()->json($data, 200);

    }

}
