<?php

namespace App\Http\Controllers;


use Session;
use App\Models\User;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Brands;
use App\Models\Comment;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
//use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //


    public function add_reply(Request $request){
      if(Auth::id()){
        $reply= new Reply;
        $reply->name=Auth::user()->username;
        $reply->user_id=Auth::user()->id;
        $reply->comment_id=$request->commentId;
        $reply->reply=$request->reply;
        $reply->save();
        return redirect()->back();

      }
      else{
        return redirect('login');
      }
    }
    public function add_comment(Request $request){
     if(Auth::id()){
      

      $comment= new Comment;
      $comment->name=Auth::user()->username;
      $comment->user_id=Auth::user()->id;

      $comment->comment=$request->comment;
      
      $comment->save();
      return redirect()->back();


     }
     else{

      return redirect('login');
     }
     

    }
  
    public function cancel_order($id){
      $order=Order::find($id);
      $order->delivery_status ='You canceled the order';
      $order->save();
      return redirect()->back();

    }

    public function show_order(){
      if(Auth::id()){
        $user=auth()->id();
        $orders=DB::table('orders')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->leftJoin('carts', 'orders.user_id', '=', 'carts.user_id')
        ->where('users.id',$user)
        ->select('users.*','products.product_title as product_title','products.product_image1 as image',
        'products.product_price as price','carts.quantity as quantity','orders.payment_status as payment_status',
        'orders.delivery_status as delivery_status','orders.id as id')
        ->get();
       
       // $order=Order::where('user_id','=')
        return view('order',compact('orders'));
      }
      else {
        return redirect('/login');
      }
    }


public function showCorrectHomePage(){


  $brands=Brands::all();
  $categories=Categories::all();
  $products=Products::orderByRaw("RAND()")->get();
   $comment=Comment::orderby('id','desc')->get();
   $reply=reply::all();
  $user=auth()->id();
  if(!isset($user)){
     
return view('home',['brands' => $brands,'categories'=> $categories,'products'=> $products,'comment' => $comment,'reply'=> $reply]);

  }
  else{
    $comment=Comment::orderby('id','desc')->get();
    $reply=reply::all();
    $cartscount =  Carts::where('user_id',auth()->user()->id)->count();
  $user=auth()->id();
  $total= DB::table('carts')
    ->join('products','carts.product_id','=', 'products.id')
    ->where('carts.user_id',$user)
    ->select('products.*','carts.quantity as quantity')
    ->get();

 
return view('home',['brands' => $brands,'categories'=> $categories,'products'=> $products,
'cartscount'=> $cartscount,'total' => $total,'comment' => $comment,'reply'=> $reply]);
 
  }


}

   
    public function logout(){
      auth()->logout();
      return redirect('/')->with('success', ' You are now logged out');
    }
   public function login(Request $request){

    $incomingFields=$request->validate([
      'loginusername'=> 'required',
      'loginpassword'=> 'required'

    ]);
    if(auth()->attempt(['username'=> $incomingFields['loginusername'],'password' => $incomingFields['loginpassword'],'usertype' => 1])){
      $request->session()->regenerate();
      //return "congrats";
      // $total_product=Products::all()->count();

          return redirect('/admin')->with('success','You have successfully logged in. ');
    }
    elseif(auth()->attempt(['username'=> $incomingFields['loginusername'],'password' => $incomingFields['loginpassword'],'usertype' => 0])){
      $request->session()->regenerate();
      //return "congrats";
      return redirect('/')->with('success','You have successfully logged in. ');
    }
    else{
      return redirect('/')->with('failure','Invalid Login');
     // return "Sorry !!!";
    }


   }



    public function register(Request $request){

      $incomingFields=$request->validate([
        'username'=>['required','min:3','max:20', Rule::unique('users','username')],
        'email'=>['required','email', Rule::unique('users','email')],
        'password'=>['required','min:8','confirmed'],
        'userimage'=>['required','image','max:3000'],
        'address'=>['required', 'min:3', 'max:255'],
        'mobileno'=>'required|numeric|digits:10'
      ]);
      $incomingFields['password'] = bcrypt($incomingFields['password']);
      if($request->hasFile('userimage')){
        $destination_path= 'public/uploads';
        $image = $request->file('userimage');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('userimage')->storeAs($destination_path,$image_name);
        $incomingFields['userimage']= $image_name;
      }
     $user= User::create($incomingFields);
     auth()->login($user);
     // return "Hello from register function";
     return redirect('/')->with('success','Thank you for Creating an account');

    }
    public function showLogin() {
      return view('user-login');
    }
    public function showRegister() {
      return view('user-registration');
    }
    public function checkoutpage(){
      
      return view('checkout');
    }
    public function cartcount(){
     // return "hello";
      // $user=auth()->user();
      // $cartcount= Carts::where('user_id',$user)->count();
      // $cartcount = Carts::where('quantity',$user->quantity)->count();
      // return view('home',compact('cartcount'));

      // $userId=Session::get('user')['id'];
      // $cart= Carts::where('user_id',$userId)->count();
      // return view('/',compact('cart'));
      // $user=auth()->user()->id;
      // $count= Carts::where('user_id',$user)->count();
      // return view('/',compact('count'));

    }
    public function showCart() {
    
  $user=auth()->id();
  $products= DB::table('carts')
    ->join('products','carts.product_id','=', 'products.id')
    ->where('carts.user_id',$user)
    ->select('product_title','product_image1','quantity','product_price')
    ->get();

    return view('cart',['products'=>$products]);

    }
    public function addToCart(Request $request){
      //return "hello im the best programmer";
      //$products=Products::findOrFail($id);
    //  dd($request);
    if(Carts::where('product_id',$request->input('product_id'))->where('user_id',auth()->user()->id)->exists()){
     // return "helloo";
      return redirect('/')->with('failure',"Already added to cart");
    }
    else {

      $cart= new Carts;
      $cart->product_id=$request->input('product_id');
      $cart->quantity=$request->input('quantity');
      $cart->user_id=auth()->user()->id;
      $cart->save();
     
      return redirect()->back()->with('success','Congratulations! Item added into cart');
    }
      

  //  $cart_count->DB::table('carts')->count('quantity');

//   $wordlist = Carts::where('user_id', '=', auth()->user()->id)->get();
// $wordCount = $wordlist->count();
    
//      return view('home',compact('wordCount'));

    }

    public function showProductDetails($id){
      //return "im the best";
      $products=Products::find($id);
      return view('product-details',compact('products','id'));

      // if(Products::where('id',$id)->exists())
      //   {
      //   $brands=Brands::where('id',$id)->first();
      //    $products=Products::where('product_image1' ,'product_image2' ,'product_image3' , $id)->get();
      //   $products=Products::where('product_image1' , $brands->id)->get();
      //    return view('product-details',compact('products'));
      //   }
      //   else{
      //    return redirect('/')->with('status',"No stock for this Brand");
      //   }
      }

      // return view('product-details');
    
 public function search(Request $request) {
   //return $request->input();
    $data= Products::where('product_keywords','like', '%' .$request->input('search_data'). '%')->get();
    return view('search',['products'=> $data]);
   //return "im the best programmer";
//   $search = $request->search;
//    if($search != ""){
//       $products= Products::where('product_keywords','LIKE', '%' .$search. '%')->
//       orWhere('product_description','like','%' .$search. '%')->get();

//    }
//    else{
//      $products = Products::all();

//    }

//    $data = compact('products','data');
//    return view('home')->with($data);
   // $search_text = $_GET['search_data'];
   // $products= Products::where('product_keywords','LIKE', '%' .$search_text. '%')->with('categories')->get();
   // return view('home',compact('products'));


 }

 public function showBrandsEachId($id){
        // return "helllo";
       
        if(Brands::where('id',$id)->exists())
        {
         $brands=Brands::where('id',$id)->first();
         $products=Products::where('brand_id' , $brands->id)->get();
         return view('product-index',compact('brands','products'));
        }
        else{
         return redirect('/')->with('status',"No stock for this Brand");
        }
      }

      public function showCategoriesEachId($id){
        // return "helllo";
       
        if(Categories::where('id',$id)->exists())
        {
         $categories=Categories::where('id',$id)->first();
         $products=Products::where('category_id' , $categories->id)->get();
         return view('product-index',compact('categories','products'));
        }
        else{
         return redirect('/')->with('status',"No stock for this category");
        }
        
       // echo $products;
        
       
       
    return view('home',['brands' => $brands,'categories'=> $categories,'products'=> $products,'id'=>$id]);
      }
     
      

         public function adminPage() {
 $usertype=Auth::user()->usertype;
//return($usertype);
          if($usertype=='1'){

            $total_product=Products::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            $products=Products::all();
            $total_revenue=0;
            foreach($products as $product){
              $total_revenue=$total_revenue + $product->product_price;


            }

            $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();

            $total_processing=Order::where('delivery_status','=','processing')->get()->count();

            return view('admin.admin',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing')); 
          }
       
        // return view('admin');
        else{

          
        
          return view('home');
        }
           
         }

        
}
