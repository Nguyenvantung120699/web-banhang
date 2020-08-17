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
use App\UsersProfile;
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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
        $rate=FeedbackProducts::where("productsId",$product->id)->get();
        $ratenew=FeedbackProducts::where("productsId",$product->id)->paginate(3);
        $img =explode(",",$product->gallery);
        $category_product =Product::where("categoriesId",$product->category_id)->where('id',"!=",$product->id)->take(10)->get();
        $brand_product =Product::where("brandsId",$product->brand_id)->where('id',"!=",$product->id)->take(10)->get();
        return view('clientView.groupPage.detailProducts',['product'=>$product,'category_product'=>$category_product,
        'brand_product'=>$brand_product,'brand'=>$brand,'img'=>$img,'rate'=>$rate,'ratenew'=>$ratenew]);
    }

    public function listingCategory($id){
        $category = Category::find($id);
        $product=$category->Products()->paginate(6);
        $categories=Category::all();
        $brands=Brand::all();
        return view("clientView.groupPage.listingCategory",['product'=>$product,'category'=>$category,'categories'=>$categories,'brands'=>$brands]);
    }
    public function listingBrand($id){
        $brand = Brand::find($id);
        $product=$brand->Products()->paginate(6);
        $categories=Category::all();
        $brands=Brand::all();
        return view("clientView.groupPage.listingBrand",['product'=>$product,'brand'=>$brand,'categories'=>$categories,'brands'=>$brands]);
    }

    public function getSearch(Request $request){
        $keys = $request->get("key");
        $product = Product::where('productName','like','%'.$request->get("key").'%')->paginate(12);
        return view("clientView.groupPage.search",['product'=>$product,'keys'=>$keys]);
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



    public function userprofileindex($id)
    {
        $user = User::find($id);
        $profile = $user->userProfile()->get();
        return view('clientView.groupPage.userProfile.index',['user'=>$user,'profile'=>$profile]);
    }

    public function userprofileStore($id,Request $request)
    {
        $id = User::find($id);
        $request->validate([
            "firstName"=> "required|string",
            "lastName" => "required|string",
            "telephone" =>"string",
            "birthday" =>"required|date",
            "gender" =>"required|Integer",
            "address" =>"required|string"
        ]);
        try {
            $avatar = null;
            $ext_allow = ["png","jpg","jpeg","gif","svg"];
            if($request->hasFile("avatar")){
                $file = $request->file("avatar");
                $file_name = time()."_".$file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                if(in_array($ext,$ext_allow)){
                    $file->move("upload/users/",$file_name);
                    $avatar = "upload/users/".$file_name;
                }      
            }

            UsersProfile::create([
                "usersId" => $iduser,
                "firstName" => $request->get("firstName"),
                "lastName" => $request->get("lastName"),
                'telephone' => $request->get("telephone"),
                "birthday" => $request->get("birthday"),
                "gender" => $request->get("gender"),
                "address" => $request->get("address"),
                'avatar' => $avatar,
            ]);
        }catch(\Exception $e){
            return redirect()->back();
        }
        return redirect()->route('user-profile', ['id' => $id]);
    }

    public function userprofileUpdate($id,Request $request){
        $profile = UsersProfile::find($id);
        $request->validate([
            "firstName"=> "required|string",
            "lastName" => "required|string",
            "telephone" =>"string",
            "birthday" =>"required|date",
            "gender" =>"required|Integer",
            "address" =>"required|string"
        ]);

        $profile = UsersProfile::find($id);
        $profile->firstName = $request->get('firstName');
        $profile->lastName = $request->get('lastName');
        $profile->telephone = $request->get('telephone');
        $profile->birthday = $request->get('birthday');
        $profile->gender = $request->get('gender');
        $profile->address = $request->get('address');
        try {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $name = time()."_".$avatar->getClientOriginalName();
                $name = $name . "." . $avatar->getClientOriginalExtension();
                $avatar->move("upload/users/",$name);

                $profile->avatar = "upload/users/".$name;
            }
        $profile->save();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->back()->with('alert', 'Save Profile Successfully');   
    }

    public function postLogin(Request $request){
        //        $request->validate([
        //            "email" => 'required|email',
        //            "password"=> "required|min:8"
        //        ]);
                $validator = Validator::make($request->all(),[
                    "email" => 'required|email',
                    "password"=> "required|min:8"
                ]);
        
                if($validator->fails()){
                    return response()->json(["status"=>false,"message"=>$validator->errors()->first()]);
                }
                $email = $request->get("email");
                $pass = $request->get("password");
                if(Auth::attempt(['email'=>$email,'password'=>$pass])){
                    return response()->json(['status'=>true,'message'=>"Login successfully!"]);
                }
                return response()->json(['status'=>false,'message'=>"login failure"]);
            }
}
