<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Carts;
use App\Models\Brands;
use App\Models\Order;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Session;
use PDF;

class AdminController extends Controller
{
    //

    public function update_product_confirm(Request $request, $id){

      $products=Products::find($id);
      $products->product_title= $request->product_title;
      $products->product_description= $request->product_description;
      $products->product_keywords = $request->product_keywords;
      $products->category_id= $request->category_id;
      $products->brand_id= $request->brand_id;

      if($request->hasFile('product_image1')){
        $destination_path= 'public/uploads';
        $image = $request->file('product_image1');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('product_image1')->storeAs($destination_path,$image_name);
        $products->product_image1 = $image_name;
      }

      if($request->hasFile('product_image2')){
        $destination_path= 'public/uploads';
        $image = $request->file('product_image2');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('product_image2')->storeAs($destination_path,$image_name);
        $products->product_image2 = $image_name;
      }

      if($request->hasFile('product_image3')){
        $destination_path= 'public/uploads';
        $image = $request->file('product_image3');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('product_image3')->storeAs($destination_path,$image_name);
        $products->product_image3 = $image_name;
      }
      // $products->product_image1= $request->product_image1;
      // $products->product_image2= $request->product_image2;
      // $products->product_image3= $request->product_image3;
      $products->product_price= $request->product_price;

      $products->save();
      return redirect()->back()->with('success','Product Updated Successfully ');


    }

    public function update_product($id){

    //  $products=Products::find($id);

      $products= DB::table('products')
          ->join('categories','products.category_id','=', 'categories.id')
          ->join('brands','products.brand_id','=', 'brands.id')
          ->where('products.id',$id)
          ->select('products.*','categories.category_title as category_title','brands.brand_title as brand_title')
          ->get();

        //  dd($products);

      //  $products=Products::find($id);
       $categories=Categories::all();
        $brands=Brands::all();
      
      

      return view('admin.update_product',compact('products','categories','brands'));
    }
    
    public function delete_product($id){
      $products=Products::find($id);

      $products->delete();

      return redirect()->back()->with('success','Products Deleted Succefully');
    }

    public function show_product(){
    //  $user=auth()->id();
      $products= DB::table('products')
          ->join('categories','products.category_id','=', 'categories.id')
          ->join('brands','products.brand_id','=', 'brands.id')
          ->select('products.*','categories.category_title as category_title','brands.brand_title as brand_title')
          ->get();
      
      return view('admin.show-product',compact('products'));
    }

    public function insertProduct(Request $request){
       
        $incomingFields = $request->validate([
           'product_title' => ['required', 'min:3', 'max:100', Rule::unique('products', 'product_title')],
         'product_description' => ['required', 'min:3', 'max:255', Rule::unique('products', 'product_description')],
           'product_keywords' => ['required', 'min:3', 'max:255', Rule::unique('products', 'product_keywords')],
           'category_id'=>'required',
           'brand_id' =>'required',
           'product_image1' => ['required','image','max:3000'],
           'product_image2' => ['required','image','max:3000'],
           'product_image3' => ['required','image','max:3000'],
           'product_price'=>['required','numeric']
           
         
       ]);
       $incomingFields['product_title'] = strip_tags($incomingFields['product_title']);
       $incomingFields['product_description'] = strip_tags($incomingFields['product_description']);
       $incomingFields['product_keywords'] = strip_tags($incomingFields['product_keywords']);
       
       $incomingFields['category_id'] =  strip_tags($incomingFields['category_id']);
       $incomingFields['brand_id'] = strip_tags($incomingFields['brand_id']);
     
       
      // $name = $request->file('product_image1')->getClientOriginalName();
      // its working
     //  $path1 = $request->file('product_image1')->store('public/uploads');
     //  $incomingFields['product_image1']= $path1;
     //  $path2   = $request->file('product_image2')->store('public/uploads');
     //  $incomingFields['product_image2']= $path2;
     //  $path3  = $request->file('product_image3')->store('public/uploads');
     //  $incomingFields['product_image3']= $path3;

      if($request->hasFile('product_image1')){
        $destination_path= 'public/uploads';
        $image = $request->file('product_image1');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('product_image1')->storeAs($destination_path,$image_name);
        $incomingFields['product_image1']= $image_name;
      }

      
      if($request->hasFile('product_image2')){
        $destination_path= 'public/uploads';
        $image = $request->file('product_image2');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('product_image2')->storeAs($destination_path,$image_name);
        $incomingFields['product_image2']= $image_name;
      }
      if($request->hasFile('product_image3')){
        $destination_path= 'public/uploads';
        $image = $request->file('product_image3');
        $image_name= $image->getClientOriginalName();
        $path = $request->file('product_image3')->storeAs($destination_path,$image_name);
        $incomingFields['product_image3']= $image_name;
      }
       


   
        $incomingFields['product_price'] = strip_tags($incomingFields['product_price']);
       // return "hello amni relax programmer";
       
       Products::create($incomingFields);
      // auth()->login($user);
       return redirect()->back()->with('success', 'Thank you for creating an account.');
   }

     
     public function showInsertProduct(){
        $brands=Brands::all();
        $categories=Categories::all();
        return view('admin.insert-product',['brands' => $brands,'categories'=> $categories]);
       

     }


    public function delete_brand($id){

        $datas=Brands::find($id);
        $datas->delete();
        return redirect()->back()->with('success','Brand Deleted Successfully');
    }

    public function delete_category($id){

     $datas=Categories::find($id);
        $datas->delete();

        return redirect()->back()->with('success','Category  Deleted Successfully');

    }


    public function insertBrands(Request $request) {
        
        $incomingFields = $request->validate([
           'brand_title' => ['required', 'min:3', 'max:100', Rule::unique('brands', 'brand_title')]

    ]);
   
    $incomingFields['brand_title'] = strip_tags($incomingFields['brand_title']);
    //$incomingFields['user_id'] = auth()->id();
    $brands=Brands::create($incomingFields);
    
     
       return redirect()->back()->with('success', 'Thank you for creating brands.');


     }
      

       

        public function showInsertBrands(){
            $datas=Brands::all();
           return view('admin.insert-brands',compact('datas'));
        }

    public function insertCategory(Request $request) {
        
        $incomingFields = $request->validate([
           'category_title' => ['required', 'min:3', 'max:100', Rule::unique('categories', 'category_title')]

    ]);
   
    $incomingFields['category_title'] = strip_tags($incomingFields['category_title']);
    //$incomingFields['user_id'] = auth()->id();
    $categories=Categories::create($incomingFields);
   
       return redirect()->back()->with('success', 'Thank you for creating categories.');

     }

    public function showInsertCategories() {
     // return "hello";

     $datas=Categories::all();
        return view('admin.insert-categories',compact('datas'));
     }


    public function admin_search(Request $request){

        $searchText=$request->search;
        $user=auth()->id();
        $orders=DB::table('orders')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->leftJoin('carts', 'orders.user_id', '=', 'carts.user_id')
        ->where('users.username','LIKE',"%$searchText%")->orWhere('users.mobileno','LIKE',"%$searchText%")->orWhere('products.product_title','LIKE',"%$searchText%")
        ->select('users.username as name','users.mobileno as mobile','users.email as email',
        'products.product_title as product_title','products.product_image1 as product_image1',
        'products.product_price as price','carts.quantity as quantity','orders.address as address',
        'orders.payment_status','orders.delivery_status','orders.id')
        ->get();
        

        return view('admin-order',compact('orders'));


    }
    public function print_pdf($id){
      

        $order=Order::find($id);
        $pdf = PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    //     $pdf=PDF::loadView('pdf');
    // return $pdf->download('order_details');



    }
    
    public function delivered($id) {
        $order=Order::find($id);
       
        $order->delivery_status="delivered";
        $order->payment_status="Paid";
        $order->save();
        return redirect()->back();
    }

    public function order(){


        $user=auth()->id();
        $orders=DB::table('orders')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->leftJoin('carts', 'orders.user_id', '=', 'carts.user_id')
        ->select('users.username as name','users.mobileno as mobile','users.email as email',
        'products.product_title as product_title','products.product_image1 as product_image1',
        'products.product_price as price','carts.quantity as quantity','orders.address as address',
        'orders.payment_status','orders.delivery_status','orders.id')
        ->get(); 
        //dd($orders);


        //return "hello";
        
        return view('admin.order',compact('orders'));
    }
}
