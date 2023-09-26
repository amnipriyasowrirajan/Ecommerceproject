<?php

namespace App\Http\Controllers;

use Session;

use App\Models\User;
use App\Models\Carts;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CartController extends Controller
{
    //

    // public function actuallyUpdatePost($id){


      

    //     $incomingFields['quantity'] = strip_tags($incomingFields['quantity']);

    //     Carts::update($incomingFields);
    //     return redirect('/');


        
    // }

    // public function showEditScreen($id){
    //   $cart=Carts::find($id);
      
    //   return view('edit',compact('cart'));
    // }

    public function removeCart($id){
       // Carts::destroy($id);
       $cart=Carts::find($id);
       $cart->delete();
        return redirect('/show-cart')->with('success',' Item removed from the cart');


    }

    public function showCart() {
    
        $user=auth()->id();
        $products= DB::table('carts')
          ->join('products','carts.product_id','=', 'products.id')
          ->where('carts.user_id',$user)
          ->select('products.*','carts.id as cart_id','carts.quantity as quantity')
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
        //  return "hello";
        //   $cartId->user_id=auth()->user()->id;

        //  $cart_count= DB::table('carts')
        //          ->select(DB::raw('count(quantity) as quantity_count'))
        //          ->where('user_id', $cartId)
        //          ->get();
        //         // dd($cart_count);
        //          return view('/',['carts'=>$cart_count]);
      
        //  $cart_count->DB::table('carts')->count('quantity');
      
      //   $wordlist = Carts::where('user_id', '=', auth()->user()->id)->get();
      // $wordCount = $wordlist->count();
          
      //      return view('home',compact('wordCount'));
      
          }
      
}
