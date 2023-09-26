
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce Website using Laravel and mysql.</title>
    <!--   bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <!--   Font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- script jquery -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
     <script type="text/javascript" src="./frontend/js/custom.js"></script>
     <!-- css main.css file -->
<link rel="stylesheet" href="/main.css">

<style>
    .center{
        margin:auto;
        width:70%;
        padding: 30px;
        text-align:center;


    }
    .th_deg{
        padding: 10px;
        background-color: skyblue;
        font-size:20px;
        font-weight:bold;
    }
</style>
</head>
<body>
    <!--  nav bar -->
    <div class="container-fluid p-0">

        <!--first child  -->
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

        <nav class="navbar navbar-expand-lg  navbar-dark bgcolor">
            <div class="container-fluid">
             <img src="./logo.png" alt="logo" class="logo">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{ url('/')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('register')}}">Register</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('show-cart') }}">
                      
                      <i class="fa-sharp fa-solid fa-cart-shopping"> </i><sup class="cart-count">{{$cartscount ?? '0'}}</sup></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ url('show_order')}}">Order</a>
                  </li>
               
                 
                </ul>
                <form class="d-flex" action="/search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" >
                  {{-- <button class="btn btn-outline-light" type="submit">Search</button> --}}
                  <input type="submit" value="Search" class="btn btn-outline-light search" >
                </form>
              </div>
            </div>
          </nav>
          <!-- second child -->
          <nav class="navbar navbar-expand-lg navbar-dark">
            <ul class="navbar-nav me-auto">
              @if(!auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>
               
                @else
                <li class="nav-item">
                  <a class="nav-link" href="#">Welcome {{auth()->user()->username}}</a>
              </li>
              @endif
              @if(!auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('login') }}">Login</a>
                </li>    
                @else
                <li class="nav-item">
                <a  class="nav-link" href="{{ url('/logout')}}"> Logout</a>
                </li>
                @endif
            </ul>
          </nav>
          <!-- third child -->

          <div >
            {{-- {{ auth()->user()->username}} --}}
            {{-- <h2> Hello  {{ auth()->user()->username}}</h2> --}}
            <h3 class="text-center text-color" > Hidden Store </h3>
            <p class="text-center text-color">Communication is at the heart of e-commerce and community </p>
          </div>
      
          <div class="row px-1">
            <div class="col-md-10">
                <!-- products -->
                <div class="row center">
                    <table class=" table-bordered text-center"  >
                            <tr>
                                <th class="th_deg"> Product Title</th>
                                <th class="th_deg"> Quantity</th>
                                <th class="th_deg"> Price</th>
                                <th class="th_deg"> Payment Status</th>
                                <th class="th_deg">Delivery Status </th>
                                <th class="th_deg">Product Image</th>
                                <th class="th_deg">Cancel Order</th>
                            </tr>
                            @foreach ($orders as $order)
                                
                           
                            <tr>

                                <td class="text-color">{{ $order->product_title }}</td>
                                <td class="text-color">{{ $order->quantity }}</td>
                                <td class="text-color">{{ $order->price }}</td>
                                <td class="text-color">{{ $order->payment_status}}</td>
                                <td class="text-color">{{ $order->delivery_status}}</td>
                                <td><img src="{{ asset('storage/uploads/'.$order->image)}}" alt="{{$order->image}}"
                                   class="cart_image" ></td>

                                   <td>
                                    @if($order->delivery_status=='processing')
                                    <a onclick="return confirm('Are you sure to Cancel the order !!!! ')" 
                                    href="{{ url('cancel_order',$order->id)}}" class="btn btn-danger">Cancel</a>
                                   </td>

                                   @else
                                   <p style="color:orange;"   class="text-color">Not Allowed</p>
                                   @endif
                           
                            </tr>
                            @endforeach
                    </table>

                </div>
            </div>
        </div>
              
          


          <!-- footer last child -->
         @include('footer')