
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
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
       crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
     <!-- js cdn link -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script type="text/javascript" src="./frontend/js/custom.js"></script>
     <!-- css main.css file -->
<link rel="stylesheet" href="/main.css">
<style>
  *{
    margin:0;
    padding: 0;
    box-sizing: border-box;
    background-color: black;
    text-decoration: none;
    /* font-family: 'Poppins', sans-serif;
    text-decoration: none;
    list-style: none; */


}
.nav-link:hover{
    color: #5CB8E4 !important;
    text-decoration: underline;

}

.card{
    transition: all 0.3s;
}
.card:hover{
    transform:scale(1.15);
}
/* :root{
    --bg-color: #222327;
    --text-color: #fff;
    --main-color: #29fd53;


} */

/* body{
    min-height:100vh; */
    /* background: var(--bg-color);
    color: var(--text-color); */

/*  
/* header{
    position: fixed;
    width: 100%;
    top:0;
    right:0;
    z-index:1000 ;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: transparent;
    padding: 28px 12%;
    transition: all .50s ease;
} */

.logo{
width: 7%;
height:7%;

}
.card-img-top{
    width: 100%;
    height: 200px;
    object-fit: contain;
}


.admin-image{
    width: 100px;
    object-fit: contain;
}

.footer{
    position:absolute;
    bottom:0;
}
.cart_image{
    width: 80px;
    height: 80px;

}

.view{
    width: 50px;
    height: 37px;
    padding: 5px;
    margin: 1px ;
    background:  #5CB8E4;
    
}

.bgcolor{
    background-color: purple;
}

.text-color{
    color: #ffffff;
}

.search{
    background:  #5CB8E4;
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
             <img src="{{ asset('logo.png')}}" alt="logo" class="logo">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
               aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/')}}">Home</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                  </li> --}}
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('register')}}">Register</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                  </li> --}}
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('show-cart') }}">
                      
                      <i class="fa-sharp fa-solid fa-cart-shopping"> </i><sup class="cart-count">{{$cartscount ?? '0'}}</sup></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('show_order')}}">Order</a>
                  </li>
                
             
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
            <h3 class="text-center text-color" > Treasure  Store </h3>
            <p class="text-center text-color">Communication is at the heart of e-commerce and community </p>
          </div>

          <!-- fourth  child -->
          <div class="row px-1">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                  {{-- @foreach ($products as $product) --}}
                    <div class="col-md-4">
                         <!-- card -->
                         <div class="card" >
                         <img src="{{ asset('storage/uploads/'.$products['product_image1']) }}"  
                         class="card-img-top" alt="{{$products['product_title']}}" width="100" height="200px">
                         <div class="card-body">
                           <h5 class="card-title text-color">{{$products['product_title']}}</h5>
                           <p class="card-text text-color"> {{$products['product_description']}}</p>
                           <form action="{{URL::to('addToCart')}}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="col-md-4">
                                <input type="number" class="form-control" name="quantity" value="1" min="1" max="{ $product->quantity }"
                               style="width:50px">
                            </div>
                            <div class="col-md-4">
                              <input type="hidden" name="product_id" value="{{ $products->id}}">
                              <input type="submit" class="btn btn-info bgcolor" style="width: 110% ;padding:5%;"   value="Add to cart">
                             
                            </div>
                            <br>
                            <a href="/"   style="width:100px;padding:0%;text-align:center;"  class="btn btn-secondary view">Back</a>
                            </div>
                          
                          </form>
                        
                           {{-- <a href="#" class="btn btn-info">Add to cart</a> --}}
                          
                          </div>
                        
                         {{-- @endforeach --}}
                    </div>
                    </div>
                
                    <div class="col-md-8">
                          <!-- related images -->
                          <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center text-info mb-5">Related Products</h4>
                            </div>
                            <div class="col-md-6">
                              <img src="{{ asset('storage/uploads/'.$products['product_image2']) }}"  
                         class="card-img-top" alt="{{$products['product_title']}}">
                            </div>
                            <div class="col-md-6">
                              <img src="{{ asset('storage/uploads/'.$products['product_image3']) }}"  
                         class="card-img-top" alt="{{$products['product_title']}}">
                              
                            </div>
                          </div>

                         
                    </div>
                  </div>
                  <!-- Fetching products -->
                  
                
                   
                    
                    
               <!-- row end -->     
                    
                </div>

        <!-- col end -->
            </div>
              <!-- brands url -->
           {{-- @include('brands') --}}

           <!-- categories url -->
           {{-- @include('categories') --}}
              
          <!-- footer last child -->
         @include('footer')