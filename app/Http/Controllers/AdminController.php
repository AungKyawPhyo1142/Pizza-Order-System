<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // go to change password page
    public function changePasswordPage(){
        return view('admin.account_info.changePassword');
    }

    // change password
        /*
            Requirements to change a passwords
            - All fields must be filled
            - New Password and Confirm Password must be greater than 6
            - New Password and Confirm Password must be the same
            - Client old password must be the same with the password inside db
        */

    public function changePassword(Request $req){

        $this->checkPasswordValidation($req);
        $currentUserId = Auth::user()->id;
        $userData = User::select('password')->where('id',$currentUserId)->first();
        $dbHashPassword = $userData->password;

        if(Hash::check($req->oldPassword, $dbHashPassword)){
            $data = ['password' => Hash::make($req->newPassword)];
            User::where('id',Auth::user()->id)->update($data);

            // logout from current account after changing the password
            Auth::logout();

            return redirect()->route('auth#loginPage');
        }

        return back()->with(['notMatch'=>'Credentials do not match']);

    }

    // go to account details page
    public function accountDetails(){
        return view('admin.account_info.details');
    }

    // go to account edit page
    public function accountEditPage(){
        return view('admin.account_info.editPage');
    }

    // update account data
    public function updateAccountData($id,Request $req){

        $this->checkAccountValidation($req);
        $data = $this->getUserData($req);

        if($req->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            // delete the old image inside db
            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$fileName); // store the file inside storage/public
            $data['image'] = $fileName; // store inside db

        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#accountDetails')->with(['updateSuccess'=>'Updated Admin Account Info Successfully!']);
    }


    // redirect the adminList page
    public function showAdminList(){

        $admin = User::when(request('searchKey'),function($query){
                            $query->orWhere('name','like','%'.request('searchKey').'%')
                                  ->orWhere('email','like','%'.request('searchKey').'%')
                                  ->orWhere('gender','like','%'.request('searchKey').'%')
                                  ->orWhere('address','like','%'.request('searchKey').'%')
                                  ->orWhere('phone','like','%'.request('searchKey').'%');
                        })
                        ->where('role','admin')->paginate(5);
        $admin->appends(request()->all());
        return view('admin.account_info.showList',compact('admin'));

    }

    public function deleteAdmin($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account deleted successfully!']);
    }

    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account_info.changeRole',compact('account'));
    }

    public function change($id,Request $req){
        $data = $this->requestUserData($req);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#showAdminList');
    }

    public function ajaxChangeRole(Request $req){
        $data = User::where('id',$req->user_id)->update([
            'role'=> $req->role,
            'updated_at' => Carbon::now()
        ]);
        return response()->json($data, 200);
    }

    // private functions

    private function requestUserData($req){
        return [
            'role' => $req->role
        ];
    }

    private function checkPasswordValidation($req){
        Validator::make($req->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }


    private function checkAccountValidation($req){
        Validator::make($req->all(),
        [
            'name'=>'required',
            'gender' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,gif,webp|file'
        ])->validate();
    }

    private function getUserData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address,
            'updated_at' => Carbon::now()
        ];
    }
}
