<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>
     <!--   bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center  justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="/register" method="POST" enctype="multipart/form-data">
                    @csrf
                
                 <!--   Username field -->
                <div class="form-outline mb-4">
                     
                    <label for="username" class="form-label" >Username</label>
                    <input value="{{old('username')}}" type="text" id="username" class="form-control"
                     placeholder="Enter your username" autocomplete="off" name="username">
                    @error('username')
                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                    @enderror
                </div>
                 <!--   email field -->
                <div class="form-outline mb-4">
                   
                  <label for="email" class="form-label" >Email</label>
                  <input value="{{ old('email')}}" type="email" id="email" class="form-control"
                   placeholder="Enter your Email Id" autocomplete="off" name="email">
                   @error('email')
                   <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                   @enderror
              </div>
               <!--   Image field -->
              <div class="form-outline mb-4">
               
              <label for="userimage" class="form-label" >User Image</label>
              <input type="file" id="userimage" class="form-control"
               name="userimage">
               @error('userimage')
               <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
               @enderror

          </div>
            <!--   password field -->
          <div class="form-outline mb-4">
          
          <label for="password" class="form-label" >Password</label>
          <input type="password" id="password" class="form-control"
           placeholder="Enter your Password" autocomplete="off" name="password">
           @error('password')
           <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
           @enderror
      </div>
       <!--  Confirm password field -->
      <div class="form-outline mb-4">
       
      <label for="confirmpassword" class="form-label" >Password</label>
      <input type="password" id="confirmpassword" class="form-control"
       placeholder="Enter your Confirm Password" autocomplete="off" name="password_confirmation">
       @error('password_confirmation')
       <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
       @enderror
  </div>
    <!--   User Address field -->
    <div class="form-outline mb-4">
                     
        <label for="address" class="form-label" >Address</label>
        <input   value="{{old('address')}}" type="text" id="address" class="form-control"
         placeholder="Enter your Address" autocomplete="off" name="address">
         @error('address')
                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
         @enderror
    </div>


    <!--   Contact field -->
    <div class="form-outline mb-4">
                     
        <label for="mobileno" class="form-label" >Contact</label>
        <input  value="{{old('mobileno')}}" type="text" id="mobileno" class="form-control"
         placeholder="Enter your Mobile Number" autocomplete="off" name="mobileno">
         @error('mobileno')
         <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
         @enderror

    </div>

    <div class="mt-4 pt-2">
        <input type="submit" value="Register"  class="bg-info py-2 px-3 border-0" name="register">
        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ?  <a href="{{url ('/login')}}" class="text-danger">Login</a></p>
    </div>
   
   

                </form>
            </div>
        </div>
    </div>
    
</body>
</html>