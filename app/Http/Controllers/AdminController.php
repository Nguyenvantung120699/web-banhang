<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

use App\Mail\OrderCreated;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\User;
use App\FeedbackProducts;
use App\Order;
use App\OrderProducts;

class AdminController extends Controller
{
    public function index()
    {
        $order = Order::count();
        $user = User::count();
        $orderss = Order::count('grandTotal');
        $orders = Order::where('status',0)->get();
        return view('adminView.index',['orderss'=>$orderss,'orders'=>$orders,'user'=>$user,'order'=>$order]);
    }

    // brand function
    public function brandIndex(){
        $brands = Brand::all();
        return view('adminView.brands.index',['brands'=>$brands]);
    }

    public function brandCreate(){
        return view('adminView.brands.create');
    }

    public function brandStore(Request $request){
        $request->validate([
            "brandsName"=> "required|string|unique:brands",
            "history" =>"string",
            "isActive" =>"required|Integer",
        ]);
        try{
            $logo = null;
            $ext_allow = ["png","jpg","jpeg","gif","svg"];
            if($request->hasFile("logo")){
                $file = $request->file("logo");
                $file_name = time()."_".$file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                if(in_array($ext,$ext_allow)){
                    $file->move("upload/brand/",$file_name);
                    $logo = "upload/brand/".$file_name;
                } 
            }
            Brand::create([
                "brandsName"=> $request->get("brandsName"),
                "logo"=> $logo,
                "history"=> $request->get("history"),
                "isActive" => $request->get("isActive")
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/brandIndex");
    }

    public function brandEdit($id){
        $brands = Brand::find($id);
        return view('adminView.brands.edit',['brands'=>$brands]);
    }

    public function brandUpdate($id, Request $request)
    {
        $request->validate([
            "brandsName"=> "required|string|unique:brands,brandsName,".$id,
            "history" =>"string",
            "isActive" =>"required|Integer",
        ]);
        $brands = Brand::find($id);
        $brands->brandsName = $request->get('brandsName');
        try {
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $name = time()."_".$logo->getClientOriginalName();
                $name = $name . "." . $logo->getClientOriginalExtension();
                $logo->move("upload/brand/",$name);

                $brands->logo = "upload/brand/".$name;
            }
        $brands->history = $request->get('history');
        $brands->isActive = $request->get('isActive');
        $brands->save();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->to("admin/brandIndex");
    }

    public function brandDestroy($id){
        $brands = Brand::find($id);
        try {
            $brands->delete();

        }catch (\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/brandIndex");
    }

    public function brandDetail($id){
        $brands = Brand::find($id);
        return view('adminView.brands.detail',['brands'=>$brands]);
    }
    // categories function

    public function categoriesIndex(){
        $categories = Category::all();
        return view('adminView.categories.index',['categories'=>$categories]);
    }

    public function categoriesCreate(){
        return view('adminView.categories.create');
    }

    public function categoriesStore(Request $request){

       $request->validate([
            "categoriesName"=> "required|string|unique:categories",
            "description" =>"string",
            "isActive" =>"required|Integer",
        ]);
        try{
            $logo = null;
            $ext_allow = ["png","jpg","jpeg","gif","svg"];
            if($request->hasFile("logo")){
                $file = $request->file("logo");
                $file_name = time()."_".$file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                if(in_array($ext,$ext_allow)){
                    $file->move("upload/categories/",$file_name);
                    $logo = "upload/categories/".$file_name;
                } 
            }      
            Category::create([
                "categoriesName"=> $request->get("categoriesName"),
                "logo"=> $logo,
                "description"=> $request->get("description"),
                "isActive"=> $request->get("isActive")
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/categoriesIndex");
    }

    public function categoryEdit($id){
        $categories = Category::find($id);
        return view("adminView.categories.edit",['categories'=>$categories]);
    }
    public function categoryUpdate($id,Request $request){

        $request->validate([
            "categoriesName"=> "required|string|unique:categories,categoriesName,".$id,
            "description" =>"string",
            "isActive" =>"required|Integer",
        ]);
        $categories = Category::find($id);
        $categories->categoriesName = $request->get('categoriesName');
        try {
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $name = time()."_".$logo->getClientOriginalName();
                $name = $name . "." . $logo->getClientOriginalExtension();
                $logo->move("upload/categories/",$name);

                $categories->logo = "upload/categories/".$name;
            }
        $categories->description = $request->get('description');
        $categories->isActive = $request->get('isActive');
        $categories->save();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->to("admin/categoriesIndex");
    }



    public function categoryDestroy($id){
        $categories = Category::find($id);
        try {
            $categories->delete();
        }catch (\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("adminView/categories");
    }

    public function categoryDetail($id){
        $categories = Brand::find($id);
        return view('adminView.categories.detail',['categories'=>$categories]);
    }

    // Product function

    public function productIndex(){
        $products = Product::all();
        return view('adminView.products.index',['products'=>$products]);
    }

    public function productCreate(){
        return view('adminView.products.create');
    }

    public function productStore(Request $request){
        $request->validate([
            "productName"=> "required|string",
            "productsDescription" => "string",
            "brandsId" =>"required|integer",
            "categoriesId" =>"required|integer",
            "price" =>"required|numeric",
            "quantity" =>"required|integer",
            "isActive" =>"required|Integer"
        ]);
        try {
            $thumbnail = null;
            $ext_allow = ["png","jpg","jpeg","gif","svg"];
            if($request->hasFile("thumbnail")){
                $file = $request->file("thumbnail");
                $file_name = time()."_".$file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                if(in_array($ext,$ext_allow)){
                    $file->move("upload/products/",$file_name);
                    $thumbnail = "upload/products/".$file_name;
                }      
            }

            $gallery = null;
            $ext_allowg = ["png","jpg","jpeg","gif","svg"];
            if($request->hasFile("gallery")){
                $fileg = $request->file("gallery");
                $file_gname = time()."_".$fileg->getClientOriginalName();
                $extg = $fileg->getClientOriginalExtension();
                if(in_array($extg,$ext_allowg)){
                    $fileg->move("upload/products/",$file_gname);
                    $gallery = "upload/products/".$file_gname;
                }      
            }
            Product::create([
                "productName" => $request->get("productName"),
                "productsDescription" => $request->get("productsDescription"),
                'thumbnail' => $thumbnail,
                'gallery' => $gallery,
                "brandsId" => $request->get("brandsId"),
                "categoriesId" => $request->get("categoriesId"),
                "price" => $request->get("price"),
                "quantity" => $request->get("quantity"),
                "isActive" => $request->get("isActive")
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/productIndex");
    }

    public function productEdit($id){
        $products = Product::find($id);
        return view("adminView.products.edit",['products'=>$products]);
    }

    public function productUpdate($id,Request $request){
        $product = Product::find($id);
        $request->validate([
            "productName"=> "required|string:products".$id,
            "productsDescription" => "string",
            "brandsId" =>"required|Integer",
            "categoriesId" =>"required|integer",
            "price" =>"required|numeric",
            "quantity" =>"required|Integer",
            "isActive" =>"required|Integer"
        ]);

        $products = Product::find($id);
        $products->productName = $request->get('productName');
        $products->productsDescription = $request->get('productsDescription');
        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $name = time()."_".$thumbnail->getClientOriginalName();
                $name = $name . "." . $thumbnail->getClientOriginalExtension();
                $thumbnail->move("upload/products/",$name);

                $products->thumbnail = "upload/products/".$name;
            }
            if ($request->hasFile('gallery')) {
                $gallery = $request->file('gallery');
                $name = time()."_".$gallery->getClientOriginalName();
                $name = $name . "." . $gallery->getClientOriginalExtension();
                $gallery->move("upload/products/",$name);

                $products->gallery = "upload/products/".$name;
            }
        $products->brandsId = $request->get('brandsId');
        $products->categoriesId = $request->get('categoriesId');
        $products->price = $request->get('price');
        $products->quantity = $request->get('quantity');
        $products->isActive = $request->get('isActive');
        $products->save();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->to("admin/productIndex");
    }

    public function productDestroy($id){

        $product = Product::find($id);
        try {
            $product->delete();

        }catch (\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/productIndex");
    }


    //user function
    public function userIndex(){
        $user = User::all();
        return view('adminView.users.index',['user'=>$user]);
    }
    public function userCreate(){
        return view('adminView.users.create');
    }
    public function userStore(Request $request){
        $request->validate([
            "email"=> "required|string|max:255|unique:users",
            "name"=> "required|string",
            "password"=> "required|string",
            "roles" => "required|Integer"
        ]);
        try{
            User::create([
                "email"=> $request->get("email"),
                "name"=> $request->get("name"),
                "password"=> $request->get("password"),
                "roles"=> $request->get("roles"),
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/userIndex");
    }


    public function userEdit($id){
        $user = User::find($id);
        return view('adminview.users.edit',['user'=>$user]);
    }
    public function userUpdate($id,Request $request){
        $user = User::find($id);
        $request->validate([
            "email"=> "required|string|email|max:255|unique:users,email,".$id,
            "name"=> "required|string|max:255,",
            "roles"=> "required|Integer",
        ]);
        try{
            $user->update([
                "email"=> $request->get("email"),
                "name"=> $request->get("name"),
                "roles"=> $request->get("roles")
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/userIndex");
    }

    public function userInfoUpdate($id,Request $request){
        $user = User::find($id);
        $request->validate([
            "name"=> "required|string|max:255:users,name,".$id,
            "email"=> "required|string|email|max:255|unique:users,email,".$id,
            "password"=> "required|string|min:8:users,password,".$id,
            "role"=> "required|Integer:users,role,".$id,
        ]);
        try{
            $avatar = null;
            $ext_allow = ["png","jpg","jpeg","gif","svg"];
            if($request->hasFile("avatar")){
                $file = $request->file("avatar");
                $file_name = time()."_".$file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                if(in_array($ext,$ext_allow)){
                    $file->move("upload/users",$file_name);
                    $avatar = "upload/users".$file_name;
                }      
            }
            $user->update([
                "name"=> $request->get("name"),
                "email"=> $request->get("email"),
                "avatar" => $avatar,
                "gender"=> $request->get("gender"),
                "address"=> $request->get("address"),
                "password" => $request->get("password"),
                "role"=> $request->get("role")
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("adminView/users");
    }

    public function userDestroy($id){
        $user = User::find($id);
        try {
            $user->delete();

        }catch (\Exception $e){
            return redirect()->back();
        }
        return redirect()->to("admin/userIndex");
    }

    //order function
    
    public function orderIndex(){
        $orders = Order::orderBy('created_at','desc')->get();
        return view('adminView.order.index',['orders'=>$orders]);
    }

}
