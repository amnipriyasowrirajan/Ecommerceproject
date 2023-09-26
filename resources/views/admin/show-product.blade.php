<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
   <!--   Font awesome link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
         .center{
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 30px;
          border: 3px solid #713ABE;
        
        
        
         } 
         
         .font-size{
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
         }

         .card-img-top{
    width: 100%;
    height: 200px;
    object-fit: contain;
}

            </style>
              
  </head>
  <body>
   
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('success'))
                <div class="container container--narrow">
                  <div class="alert alert-success text-center">
                   <button type="button" class="close" 
                   data-dismiss="alert" aria-hidden="true">x</button>
                    {{session('success')}}
                  </div>
                </div>
                @endif
                @if (session()->has('failure'))
        
                <div class="container container--narrow">
                  <div class="alert alert-danger text-center">
                    <button type="button" class="close" 
                    data-dismiss="alert" aria-hidden="true">x</button>
                    {{session('failure')}}
                  </div>
                </div>
        
        
                @endif

                <h2 class="font-size">All Products</h2>
                <table class="table-bordered center">
                    <tr>
                      <th> Product Title</th>
                      <th> Product Description</th>
                      <th> Category</th>
                      <th> Brand</th>
                      <th> Product Image 1</th>
                      <th> Product Image 2</th>
                      <th> Product Image 3</th>
                      <th> Product Price</th>
                      <th colspan="2">Action</th>
                    </tr>
  
                    @foreach($products as $product)
                    <tr>
                      <td>{{$product->product_title}}</td>
                      <td>{{$product->product_description}}</td>
                      <td>{{$product->category_title}}</td>
                      <td>{{$product->brand_title}}</td>
                      <td><img src="storage/uploads/{{$product->product_image1}}" class="card-img-top" 
                        alt="{{$product->product_image1}}"></td>
                        <td><img src="storage/uploads/{{$product->product_image2}}" class="card-img-top" 
                            alt="{{$product->product_image2}}"></td>
                            <td><img src="storage/uploads/{{$product->product_image3}}" class="card-img-top" 
                                alt="{{$product->product_image3}}"></td>
                      <td>{{$product->product_price}}$</td>
                     <td><a onclick="return confirm('Are you Sure to Delete this ')" 
                        href="{{url('delete_product',$product->id)}}" class="btn btn-danger">
                      <i class="fa-solid fa-trash"></i></a>
                      <br>
                      <br>
                      <a 
                      href="{{url('update_product',$product->id)}}" class="btn btn-primary">
                      <i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                    </tr>
                    @endforeach
                  </table>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
   <!-- End custom js for this page -->
  </body>
</html>