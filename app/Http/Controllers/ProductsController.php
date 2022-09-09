<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    // go to product list page
    public function showList(){
        $pizzas = Products::select('products.*','categories.name as category_name')
                            ->when(request('searchKey'),function($query){
                                $query->where('products.name','like','%'. request('searchKey') .'%');
                            })
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->paginate(3);
                            $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    // go to create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // create data inside db
    public function create(Request $req){
        $this->checkProductValidation($req,'create');
        $data = $this->getProductData($req);

        $fileName = uniqid().$req->file('pizzaImage')->getClientOriginalName();
        $req->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']= $fileName;

        Products::create($data);
        return redirect()->route('product#showList');
    }

    // delete data from db
    public function delete($id){
        Products::where('id',$id)->delete();
        return redirect()->route('product#showList')->with(['deleteSuccess'=>'Pizza data deleted successfully!']);
    }

    // go to pizza details page
    public function details($id){
        $pizza = $this->getProductDataFromID($id);
        return view('admin.product.details',compact('pizza'));
    }

    // go to pizza edit page
    public function editPage($id){
        $pizza = $this->getProductDataFromID($id);
        $categories = Category::get();
        return view('admin.product.editPage',compact('pizza','categories'));
    }

    // edit the pizza info
    public function edit(Request $req){

        $this->checkProductValidation($req,'update');
        $data = $this->getProductData($req);

        if($req->hasFile('pizzaImage')){
            $dbImage = Products::where('id',$req->pizzaID)->first();
            $dbImage = $dbImage->image;

            Storage::delete('public/'.$dbImage);

            $fileName = uniqid().$req->file('pizzaImage')->getClientOriginalName();
            $req->file('pizzaImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;

        }

        Products::where('id',$req->pizzaID)->update($data);
        return redirect()->route('product#showList');

    }

    /* --------------------- Private Functions --------------------- */

    private function getProductDataFromID($id){
        $pizza = Products::where('id',$id)->first();
        return $pizza;
    }

    private function getProductData($req){
        return [
            'name' => $req->pizzaName,
            'description' => $req->pizzaDescription,
            'category_id' => $req->pizzaCategory,
            'price' => $req->pizzaPrice,
            'waiting_time' => $req->pizzaWaitingTime
        ];
    }

    private function checkProductValidation($req,$status){
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$req->pizzaID,
            'pizzaCategory' => 'required',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required'
        ];

        $validationRules['pizzaImage'] = $status == "create" ? 'required|mimes:jpg,png,jpeg,gif,webp|file' : 'mimes:jpg,png,jpeg,gif,webp|file';

        Validator::make($req->all(),$validationRules)->validate();

    }
}

