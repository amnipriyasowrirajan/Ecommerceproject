<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce Website Cart Details.</title>
    <!--   bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <!--   Font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!--   Custom.js file link-->
      <script src="{{ asset('./js/custom.js')}}"></script>
<!-- css main.css file -->
<link rel="stylesheet" href="main.css">
</head>
<body>
    <!--  nav bar -->
    <div class="container-fluid p-0">

        <!--first child  -->
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

        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
             <img src="./logo.png" alt="logo" class="logo">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Register</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('cart') }}">
                      <i class="fa-sharp fa-solid fa-cart-shopping"></i><sup class="cart-count">1</sup></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Total Price:100/-</a>
                  </li>
                 
                </ul>
              
              </div>
            </div>
          </nav>
          <!-- second child -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>          
            </ul>
          </nav>
          <!-- third child -->

          <div class="bg-light">
            <h3 class="text-center"> Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community </p>
          </div>
           <!-- fourth child -->
           <div class="container">
            <div class="row">
              @php
              $total = 0;

              @endphp
              <form action="" method="post">
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th> Price</th>
                    {{-- <th>Remove</th> --}}
                    <th colspan="1">Operations</th>
                  </tr>
                </thead>
                
                <tbody>
                  @foreach($products as $product)
                  <tr>
                    <td>{{$product->product_title}}</td>
                    <td><img src="{{ asset('storage/uploads/'.$product->product_image1)}}" alt="" class="cart_image" ></td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->product_price}}$</td>
                    {{-- <td><input type="checkbox" name="removeitem[]" value="Remove Product_id"></td> --}}
                    <td>
                     {{-- <button class="bg-info p-3 py-2 border-0 mx-3">Update</button> --}}
                     {{-- <input type="submit" value="Update Cart" class="bg-info p-3 py-2 border-0 mx-3" 
                     name="update_cart" > --}}
                     {{-- <a href="/edit/{{$product->cart_id}}"
                      class="bg-info p-3 py-2 border-0 mx-3 text-light text-decoration-none">Update</a> --}}
                     {{-- <button class="bg-info p-3 py-2 border-0 mx-3">Remove</button> --}}
                     <a href="/removecart/{{$product->cart_id}}" onclick="return confirm('Are you sure to remove this product ?')"
                       class="bg-danger p-3 py-2 border-0 mx-3 text-light text-decoration-none">Remove</a>
                     {{-- <input type="submit" value="Remove Cart" class="bg-danger p-3 py-2 border-0 mx-3"
                      name="remove_cart" > --}}
                    </td>
                  </tr>
                  @php
                  $total += $product->product_price * $product->quantity;
                  
                  @endphp
                  @endforeach
                </tbody>
              </table>
              <br>
              <br>
              <br>
             
             
               <!-- subtotal -->
               <div class="d-flex  mb-5">
                <h4 class="px-3">  Total Price:   <strong class="text-info">{{ $total }}$</strong></h4>
                <button class="bg-info p-3 py-2 border-0 mx-3">
                  <a href="{{ url('cash_order') }}" class="text-light text-decoration-none">Cash on Delivery
                 </button></a>
               <button class="bg-secondary p-3 py-2 border-0 text-light"> 
                <a href="{{url('stripe',$total)}}" class="text-light text-decoration-none"> Checkout</a></button>
              </div>
            </div>
           </div> 
          </form>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
         
          <!-- footer last child -->
         @include('footer')