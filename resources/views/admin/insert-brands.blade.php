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
                <div class="div_center">
                    <h2>Add Brands</h2>
             <br>
          
             <form action="/insert-brands" method="POST" class="mb-2">
                 @csrf
                 <div class="input-group w-90 mb-3">
                     <span class="input-group-text bg-info" 
                     id="basic-addon1"><i class="fa-solid fa-receipt"> </i></span>
                     <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" 
                     aria-label="brands" aria-describedby="basic-addon1">
                     @error('brand_title')
                     <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                     @enderror
                   </div>
                   <div class="input-group w-10 mb-2 m-auto">
                     <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brand" value="Insert Brands" 
                     aria-label="Username" aria-describedby="basic-addon1">
                     
                     </div>
             
             </form> 
                </div>
                <table class="table-bordered center">
                  <tr>
                    <th>Brand Name</th>
                    <th>Action</th>
                  </tr>

                  @foreach($datas as $data)
                  <tr>
                    <td>{{$data->brand_title}}</td>
                   <td><a onclick="return confirm('Are you Sure to Delete this ')" href="{{url('delete_brand',$data->id)}}" class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i></a></td>
                  </tr>
                  @endforeach
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
   <!-- End custom js for this page -->
  </body>
</html>