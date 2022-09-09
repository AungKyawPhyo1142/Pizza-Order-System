<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function homePage(){
        $pizza = Products::orderBy('created_at','desc')->get();
        $category = Category::get();
        return view('user.mainPage.home',compact('pizza','category'));
    }

    // change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // change password
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

    public function accountChangePage(){
        return view('user.profile.account');
    }

    public function accountChange($id,Request $req){

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
        return back()->with(['updateSuccess'=>'Updated Account Info Successfully!']);

    }

    public function filter($categoryId){

    }

    // private functions

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
