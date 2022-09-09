<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    // go to listPage
    public function list(){
        $categories = Category::when(request('searchKey'),function($query){
                                        $query->where('name','like','%'.request('searchKey').'%');
                                    })
                                    ->orderBy('id','asc')
                                    ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    // go to create page
    public function createPage(){
        return view('admin.category.create');
    }

    // create(input) data
    public function create(Request $req){
        $this->categoryValidateCheck($req);
        $data = $this->getCategoryData($req);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Data created successfully!']);
    }

    // delete data
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess'=>'Data deleted successfully!']);
    }

    // go to edit Page
    public function editPage($id){
        $data = Category::where('id',$id)->first();
        return view('admin.category.editPage',compact('data'));
    }

    // update data
    public function update(Request $req){
        $this->categoryValidateCheck($req);
        $data = $this->getCategoryData($req);
        Category::where('id',$req->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    // private functions

    private function categoryValidateCheck($req){
        Validator::make($req->all(),[
            'categoryName' => 'required|unique:categories,name,'.$req->categoryId
        ])->validate();
    }

    private function getCategoryData($req){
        return [
            'name' => $req->categoryName
        ];
    }
}
