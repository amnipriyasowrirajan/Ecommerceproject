<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
  
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
                <div class="div_center">
                    <h1>Add Product</h1>
                    <br>
                    <br>
                    <form action="/insert-product" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Title -->
                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_title" class="form-label">Product Title</label>
                            <input type="text" name="product_title" id="product_title" 
                            class="form-control" placeholder="Enter the product title" autocomplete="off">
                            @error('product_title')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_description" class="form-label">Product Description</label>
                            <input type="text" name="product_description" id="product_description" 
                            class="form-control" placeholder="Enter the Description" autocomplete="off">
                            @error('product_description')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
            
                         <!-- keywords -->
                         <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_keywords" class="form-label">Product Keywords</label>
                            <input type="text" name="product_keywords" id="product_keywords" 
                            class="form-control" placeholder="Enter the Product Keywords" autocomplete="off">
                            @error('product_keywords')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
            <br>

            
                        <!-- Categories -->
                        <div class="form-outline mb-4 w-50 m-auto ">
                          <select name="category_id" id="category_title" class="form-select" style="width: 480px">
                            <option value="">Select a Categories</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_title}}</option>
                            @endforeach
                          </select>
            
                          @error('category_id')
                          <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                          @enderror
                        </div>

                        <br>
            
                         <!-- Brands -->
                         <div class="form-outline mb-4 w-50 m-auto">
                            <select name="brand_id" id="brand_title" class="form-select" style="width: 480px">
                                <option value="">Select a Brands</option>
                                @foreach ($brands as $brand)
                               
                              <option value="{{$brand->id}}">{{$brand['brand_title']}}</option>
                              @endforeach
                            </select>
                            @error('brand_id')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                          </div>
                          <br>
                              <!-- image 1 -->
                         <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_image1" class="form-label">Product Image 1</label>
                            <input type="file" name="product_image1" id="product_image1" 
                            class="form-control" placeholder="Enter the Product Image 1" autocomplete="off">
                            @error('product_image1')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
            
                         <!-- image 2 -->
                         <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_image2" class="form-label">Product Image 2</label>
                            <input type="file" name="product_image2" id="product_image2" 
                            class="form-control" placeholder="Enter the Product Image 2" autocomplete="off">
                            @error('product_image2')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
            
                         <!-- image 3 -->
                         <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_image3" class="form-label">Product Image 3</label>
                            <input type="file" name="product_image3" id="product_image3" 
                            class="form-control" placeholder="Enter the Product Image 3" autocomplete="off">
                            @error('product_image3')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                         <!-- Price -->
                         <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" name="product_price" id="product_price" 
                            class="form-control" placeholder="Enter the Product Price" autocomplete="off">
                            @error('product_price')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                            @enderror
                        </div>
                 <br>
               
                         <!-- Price -->
                         <div class="form-outline mb-4 w-50 m-auto">
                           <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
                        </div>
            
                        
            
                    </form>
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