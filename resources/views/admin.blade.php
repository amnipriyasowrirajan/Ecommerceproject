<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <!-- Bootstrap and css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
     <!--   Font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
<link rel="stylesheet" href="/main.css">
<script>
$(document).ready(function() {
    $("#insert_category").hide();
    $("#insert_brand").hide();
});


// $(document).onclick(function() {
//     $("#myDIV").show();
// });

    function insertCategory() {
      var x = document.getElementById("insert_category");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function insertBrands() {
      var x = document.getElementById("insert_brand");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    
    </script>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
<div class="container-fluid">
    <img src="./logo.png" alt="logo" class="logo" >
    <nav class="navbar navbar-expand-lg ">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="" class="nav-link">Welcome Guest</a>
            </li>
        </ul>
    </nav>

</div>
        </nav>
         <!-- second child -->
         <div class="bg-light">
            <h3 class="text-center p-2">
                Manage Details
            </h3>
         </div>
         <!-- Third child  horizotal row we use these classes-->
          <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="./images/pineapplejuice.jpg" alt="pineapple" class="admin-image"></a>
                    <p class="text-light text-center">
                        Admin Name
                    </p>
                </div>
                    {{-- button*10>a.nav-link.text-light.bg-info.my-1 --}}
                <div class="button text-center">
                    <button class="text-light btn btn-outline-info my-1"><a href="insert-product" class="text-light text-decoration-none">
                        Insert Products</a></button>
                    <button class="text-light btn btn-outline-info my-1" >View Poducts</button>
                    {{-- <button><a href="admin" class="nav-link text-light bg-info my-1">
                        Insert Categories</a></button> --}}
                <button onclick="insertCategory()" class="text-light btn btn-outline-info my-1">
                           Insert Categories</button>
                <button class="text-light btn btn-outline-info my-1" >View Categories</button>
            <button onclick="insertBrands()" class="text-light btn btn-outline-info my-1" >Insert Brands</button>
                    <button  class=" text-light btn btn-outline-info my-1"> View Brands</button>
                    <button  class="text-light btn btn-outline-info my-1"><a href="{{url('order')}}" class="text-light text-decoration-none">
                        All Orders</a></button>
                    <button class="text-light btn btn-outline-info my-1" >All Payments</button>
                    <button  class="text-light btn btn-outline-info my-1">List Users</button>
                    <button class="text-light btn btn-outline-info my-1" ><a  href="{{ url('/logout')}}"
                         class="text-light text-decoration-none">
                       Logout</a></button>

                </div>
            </div>
          </div>
          <!-- fourth child -->

          <div class="container my-3">
                {{-- @if(isset($_GET['insert-categories'])) --}}
                @error('category_title')
                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                @enderror
                <div id="insert_category">
                    @include('insert-categories')
                </div>
                @error('brand_title')
                 <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                @enderror
                <div id="insert_brand">
                @include('insert-brands')
                </div>
               
          </div>

         @include('footer')