<?php

namespace App\Http\Controllers;


use App\Models\User;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Carts;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    //


    
    public function cashOrder() {

        $user=auth()->id();
        //dd($user);
  
       // $data=Carts::where('user_id', '=', $user)->get();
       $data= DB::table('carts')
       ->join('users','carts.user_id','=', 'users.id')
       ->where('carts.user_id',$user)
       ->select('users.address','carts.id as cart_id','carts.user_id as user_id','carts.product_id as product_id')
       ->get();
        //dd($data);
  
        foreach($data as $data){
          $order= new Order;
          $order->product_id = $data->product_id;
          $order->user_id = $data->user_id;
          $order->address = $data->address;
          $order->payment_status = 'cash on delivery';
          $order->delivery_status = 'processing';
          $order->save();
  
          $cart_id=$data->cart_id;
          $cart=Carts::find($cart_id);
          $cart->delete();
          
        }
  
        return redirect()->back()->with('success','We have received your order. We will connect with you soon...');
  
  
  
      }
  
  
    public function stripe($total){


        return view('stripe',compact('total'));

    }

    public function stripePost(Request $request,$total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       // dd($total);
        Stripe\Charge::create ([
                "amount" => $total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment." 
        ]);


        $user=auth()->id();
        //dd($user);
  
       // $data=Carts::where('user_id', '=', $user)->get();
       $data= DB::table('carts')
       ->join('users','carts.user_id','=', 'users.id')
       ->where('carts.user_id',$user)
       ->select('users.address','carts.id as cart_id','carts.user_id as user_id','carts.product_id as product_id')
       ->get();
        //dd($data);
  
        foreach($data as $data){
          $order= new Order;
          $order->product_id = $data->product_id;
          $order->user_id = $data->user_id;
          $order->address = $data->address;
          $order->payment_status = 'Pay using card';
          $order->delivery_status = 'processing';
          $order->save();
  
          $cart_id=$data->cart_id;
          $cart=Carts::find($cart_id);
          $cart->delete();
          
        }

       
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
}
