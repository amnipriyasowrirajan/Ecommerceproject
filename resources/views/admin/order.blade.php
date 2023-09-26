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
         .blue{
      background: #713ABE;
    }

    table {
width: 90%;

}
.center{
text-align: center;
}

.cart_image{
    width: 80px;
    height: 80px;

}
         /* .text-color{
            color: black;
            padding-bottom: 20px;
         } */
   
            </style>


  

      
      
  </head>
  <body>
    @if (session()->has('success'))
    <div class="container container--narrow">
      <div class="alert alert-success text-center">
        {{session('success')}}
      </div>
    </div>
    @endif
    @if (session()->has('failure'))

    <div class="container container--narrow">
      <div class="alert alert-danger text-center">
        {{session('failure')}}
      </div>
    </div>


    @endif
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

               
                    <h1 class="div_center">All Orders</h1>
                    <br>
                    <div style="padding-left: 4px ;padding-bottom:30px" class="center">
                        <form action="{{url('admin_search')}}" method="get">
                          @csrf
                          <input type="text" name="search" placeholder="Search For Something">
                          <input type="submit" value="Search" class="btn btn-outline-info">
                        </form>
                      </div>
                      <br>
                    
                      <table class=" table-bordered text-center"  >
                        <thead>
                          <tr class="blue">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Mobile No</th>
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Image</th>
                            <th>Delivered</th>
                            <th>Print PDF</th>
                            {{-- <th>Send Email</th> --}}
              
                           
                          </tr>
                        </thead>
                        
                        <tbody>
                          @forelse($orders as $order)
                          <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->mobile}}</td>
                            <td>{{$order->product_title}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->payment_status}}</td>
                            <td>{{$order->delivery_status}}</td>
                            <td><img src="{{ asset('storage/uploads/'.$order->product_image1)}}" alt="" class="cart_image" ></td>
                           
                            <td>
                              @if($order->delivery_status=='processing')
                              
                              <a href="{{ url('delivered',$order->id)}}" 
                                onclick="return confirm('Are you sure this product is  delivered !!!')"
                                 class="btn btn-info"> Delivered</a>
              
                              @else
                              <p style="color: green">Delivered</p>
              
                              @endif
              
                            </td>
                            <td><a href="{{url('print_pdf',$order->id)}}" class="btn btn-danger"> <i class="fa-solid fa-file-pdf"></i></a></td>
                            {{-- <td>
                              <a href="{{url('send_email',$order->id)}}" class="btn btn-info"> Email</a>
                            </td> --}}
                          </tr>
                         
                        </tbody>
                        @empty
                        <tr>
                          <td colspan="16">No Data Found</td>
                        </tr>
                       
                        @endforelse
                      </table>
                       
                   
                    </div>
               
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
   <!-- End custom js for this page -->
  </body>
</html>