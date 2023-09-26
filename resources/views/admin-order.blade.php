<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
       <!-- Bootstrap and css link -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
         <!--   Font awesome link -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <!-- css link -->
    <link rel="stylesheet" href="main.css">
    <style>
      .blue{
        background: #87CEEB;
      }

      table {
  width: 100%;
}
.center{
  text-align: center;
}
      </style>
</head>
<body>
    <div class="container mt-3">
      <h1 class="text-center" >All Orders</h1>
      <br>
      <div style="padding-left: 4px ;padding-bottom:30px" class="center">
        <form action="{{url('admin_search')}}" method="get">
          @csrf
          <input type="text" name="search" placeholder="Search For Something">
          <input type="submit" value="Search" class="btn btn-outline-primary">
        </form>
      </div>
    
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

</body>
</html>