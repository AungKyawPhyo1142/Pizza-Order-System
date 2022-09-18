<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // show user list
    public function showUserList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    // change user role
    public function changeUserRole(Request $req){
        $updateSource = [
            'role'=> $req->role,
            'updated_at' => Carbon::now()
        ];
        $data = User::where('id',$req->user_id)->update($updateSource);
        return response()->json($data, 200);
    }

    // show feedbacks
    public function feedbacks(){
        $data = Contact::paginate(5);
        return view('admin.user.feedback',compact('data'));
    }

    // delete feedbacks
    public function deleteFeedbacks($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Feedback Deleted Successfully!']);
    }

    // view feedbacks
    public function viewFeedbacks($id){
        $data = Contact::where('id',$id)->first();
        return view('admin.user.feedbackDetails',compact('data'));
    }

}
