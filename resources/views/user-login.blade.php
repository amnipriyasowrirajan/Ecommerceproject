<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
     <!--   bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center  justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="/login" method="POST" enctype="multipart/form-data">
                    @csrf
                
                 <!--   Username field -->
                <div class="form-outline mb-4">
                     
                    <label for="loginusername" class="form-label" >Username</label>
                    <input type="text" id="loginusername" class="form-control"
                     placeholder="Enter your username" autocomplete="off" name="loginusername">

                </div>
              
            <!--   password field -->
          <div class="form-outline mb-4">
          
          <label for="loginpassword" class="form-label" >Password</label>
          <input type="password" id="loginpassword" class="form-control"
           placeholder="Enter your Password" autocomplete="off" name="loginpassword">

      </div>
       
   

    <div class="mt-4 pt-2">
        <input type="submit" value="Login"  class="bg-info py-2 px-3 border-0" name="login">
        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ?  <a href="{{url ('/register')}}"
             class="text-danger">Register</a></p>
    </div>
   
   

                </form>
            </div>
        </div>
    </div>
    
</body>
</html>