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

<!-- css main.css file -->
<link rel="stylesheet" href="main.css">
</head>
<body>
    <!--  nav bar -->
    <div class="container-fluid p-0">

        <!--first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
             <img src="{{ asset('./logo.png')}}" alt="logo" class="logo" width="30" height="30">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
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
                    <a class="nav-link" href="#"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup>1</sup></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Total Price:100/-</a>
                  </li>
                 
                </ul>
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
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
          <!-- fourth  child -->
          <div class="row px-1">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                  <!-- Fetching products -->
                  
                
                 
                    {{-- @if(isset($categories))
                    @if(isset($brands)) --}}

                  @foreach ($products as $product)
                    <div class="col-md-4 mb-2 searched-item">
                        <div class="card" >
                          <!--  products  is displayed-->
                        
                            <img src="{{ asset('storage/uploads/'.$product['product_image1']) }}" class="card-img-top" alt="{{$product['product_title']}}">
                            <div class="card-body">
                              <h5 class="card-title">{{$product['product_title']}}</h5>
                              <p class="card-text">{{$product['product_description']}}</p>
                              <a href="#" class="btn btn-info">Add to cart</a>
                              <a href="#" class="btn btn-secondary">View more</a>
                            </div>
                          </div>
                    </div>
                    @endforeach
                    {{-- @endif
                    @endif --}}
                    
                    
               <!-- row end -->     
                    
                </div>

        <!-- col end -->
            </div>
                     <!-- footer last child -->
       
                     @include('footer')
                     