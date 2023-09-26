
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
                  @php
                  $totalcount = 0;

                
                  @endphp


@if(!auth()->check())
@php
 $total=0
 @endphp
 @else
@foreach($total as $totals)
@php 
$totalcount += $totals->product_price * $totals->quantity;

@endphp

@endforeach

@endif
                  <li class="nav-item">
                   
                    <a class="nav-link" href="#">Total Price:{{ $totalcount ?? '0' }}/-</a>
                   
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
            <h3 class="text-center text-color" > Treasure  Store </h3>
            <p class="text-center text-color">Communication is at the heart of e-commerce and community </p>
          </div>
          <!-- fourth  child -->
          <div class="row px-1">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                  <!-- Fetching products -->
                  
                
                 @include('products')
                  

                  {{-- Comment and reply system starts here--}}
                  {{-- @if(!auth()->check()) --}}
                    <div style="text-align: center; padding-bottom:30px">
                      <h1 class="text-color" 
                      style="font-size: 30px; text-align: center; padding-top:20px; padding-bottom:20px">
                      Comments</h1>
                      <form action="{{ url('add_comment')}}" method="POST">
                        @csrf
                        <textarea style="height:150px; width:600px;"  class="text-color"
                         placeholder="Comment Something Here" name="comment"></textarea>
                       <br>
                        {{-- <a href="" class="btn btn-primary">Comment</a> --}}
                        <input type="submit" class="btn btn-primary" value="Comment">
                      </form>
                    </div>
                    {{-- @else --}}
                    <div style="padding-left: 20%">
                      <h1  class="text-color"  style="font-size: 20px;padding-bottom: 20px;">All Comments</h1>
                 @foreach ($comment as $comment)
                     
                 

                    <div>
                      <b class="text-color" >{{$comment->name}}</b>
                      <p class="text-color" >{{$comment->comment}}</p>

                      <a href="javascript::void(0);" onclick="reply(this)" data-Commentid={{$comment->id}}>Reply</a>
                  
                      @foreach ($reply as $rep)
                          
                    @if($rep->comment_id==$comment->id)
                      <div style="padding-left: 3%;padding-bottom:10px;padding-bottom:10px;">
                        <b class="text-color" >{{$rep->name}}</b>
                        <p class="text-color" >{{$rep->reply}}</p>
                        <a href="javascript::void(0);" onclick="reply(this)" data-Commentid={{$comment->id}}>Reply</a>
                  

                      </div>
                      @endif
                      @endforeach
                  
                    </div>
                   
                    @endforeach


                    {{-- Reply Textbox --}}

                    
                      <div style="display:none;" class="replyDiv">
                        <form action="{{ url('add_reply')}}" method="post">
                          @csrf
                        <input class="text-color" type="text" name="commentId" id="commentId" hidden>
                        <textarea class="text-color" style="height:100px;width:500px;" 
                         name="reply" placeholder="write something here" required> </textarea>
                        <br>
                      
                        {{-- <input type="submit"  value="reply" class="btn btn-primary"> --}}
                        <button type="submit" class="btn btn-primary">Reply</button>
                        <a href="javascript::void(0);" class="text-color btn" onclick="reply_close(this)">Close</a>
                      </form>  
                      </div>
                    
                      </div>
                    
                      {{-- @endif --}}

                   {{-- Comment and reply system ends here--}}
                    

                 
               <!-- row end -->     
                    
                </div>

        <!-- col end -->
            </div>

            <script>
              function reply(caller){
                document.getElementById('commentId').value=$(caller).attr('data-Commentid');
                $('.replyDiv').insertAfter($(caller));

                $('.replyDiv').show();

              }

              function reply_close(caller){
              

                $('.replyDiv').hide();

              }
              </script>

<script>
  document.addEventListener("DOMContentLoaded", function(event) { 
      var scrollpos = localStorage.getItem('scrollpos');
      if (scrollpos) window.scrollTo(0, scrollpos);
  });

  window.onbeforeunload = function(e) {
      localStorage.setItem('scrollpos', window.scrollY);
  };
</script>
           @include('brands')

           <!-- categories url -->
           @include('categories')
              
          


          <!-- footer last child -->
         @include('footer')