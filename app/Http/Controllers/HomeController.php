<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
use App\Category;
use App\Brand;
use App\Product;
use App\User;
use App\FeedbackProducts;
use App\Order;
use App\OrderProducts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brand = Brand::orderBy('created_at','desc')->take(4)->get();
        $products = Product::orderBy('created_at','desc')->take(8)->get();
        return view('clientView.groupPage.index',["products"=>$products,"brand"=>$brand]);
    }

    public function productDetail($id){
        $product=Product::find($id);
        $brand = Brand::find($product->brandsId);
        $img =explode(",",$product->gallery);
        $category_product =Product::where("categoriesId",$product->category_id)->where('id',"!=",$product->id)->take(10)->get();
        $brand_product =Product::where("brandsId",$product->brand_id)->where('id',"!=",$product->id)->take(10)->get();
        return view('clientView.groupPage.detailProducts',['product'=>$product,'category_product'=>$category_product,'brand_product'=>$brand_product,'brand'=>$brand,'img'=>$img]);
    }

    public function listingCategory($id){
        $category = Category::find($id);
        $product=$category->Products()->paginate(9);
        $categories=Category::all();
        $brands=Brand::all();
        return view("clientView.groupPage.listingCategory",['products'=>$product,'category'=>$category,'categories'=>$categories,'brands'=>$brands]);
    }

    public function openCart()
    {
        return view('clientView.groupPage.cart');
    }
    public function shopping($id, Request $request){
        $product=Product::find($id);
        $cart =$request->session()->get("cart");

        if($cart==null){
            $cart=[];
        }
        foreach ($cart as $p){
            if($p->id == $product->id){
                $p->cart_qty =$p->cart_qty+1;
                session(["cart"=>$cart]);
                return view("clientView.groupPage.cart",["cart"=>$cart]);
            }
        }
        $product->cart_qty=1;
        $cart[]=$product;
        session(["cart"=>$cart]);
        return view("clientView.groupPage.cart",["cart"=>$cart]);
    }
    public function pshopping($id, Request $request){
        $product=Product::find($id);
        $cart =$request->session()->get("cart");
        $request->validate([
            'qty'=> 'required|integer',
        ]);
        if($cart==null){
            $cart=[];
        }
        foreach ($cart as $p){
            if($p->id == $product->id){
                $p->cart_qty = $p->cart_qty+$request->get("qty");
                session(["cart"=>$cart]);
                return view("clientView.groupPage.cart",["cart"=>$cart]);
            }
        }
        $product->cart_qty=$request->get("qty");
        $cart[]=$product;
        session(["cart"=>$cart]);
        return view("clientView.groupPage.cart",["cart"=>$cart]);
    }
    public function cart(Request $request){
    $cart = $request->session()->get("cart");
    if($cart == null){
        $cart = [];
    }
    $cart_total = 0 ;
    foreach ($cart as $p){
        $cart_total += ($p->price*$p->cart_qty);
    }
    return view("cart",["cart"=>$cart,'cart_total'=>$cart_total]);

}
    public function reduceOne($id,Request $request){
        if(!$cart=session()->has("cart")){
            return redirect()->to("/");
        }
        $cart =$request-> session()->get('cart');
        foreach ($cart as $p){
            if($p->id ==$id){
                $p->cart_qty-=1;
                return redirect()->to("/cart");
            }
        }
        return redirect()->to("/cart");
    }
    public function increaseOne($id,Request $request){
        if(!$cart=session()->has("cart")){
            return redirect()->to("/");
        }
        $cart =$request-> session()->get('cart');
        foreach ($cart as $p){
            if($p->id ==$id){
                $p->cart_qty+=1;
                return redirect()->to("/cart");
            }
        }
        return redirect()->to("/cart");
    }
    public function clearCart(Request $request){
        $request->session()->flush(); // xoa tat ca session - ke ca login
        return redirect()->to("/");
    }
}
