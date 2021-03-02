<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="AgroInnova-GH">
  <meta name="author" content="AgroInnova-GH">
  <meta name="keyword" content="AgroInnova-GH">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>Admin | Login</title>
  <link href="font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css"/>
  <link href="loginxcripts/Copy (2) of styles2.css" rel="stylesheet" type="text/css"/>
  <link href="loginxcripts/styles2.css" rel="stylesheet" type="text/css"/>
  <link href="loginxcripts/Copy of styles2.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        form {
            width: 100% !important;
        }

        button.btn-primary:hover {
          background-color: #075e54 !important;
          border: 1px solid #075e54;
        }

        body {
             background-image: url("hatchchicken.jpg");
                
              background-size: cover;
    background-position: center center;
    position: relative;
    padding: 190px 0;  
            
           
        }
    </style>

</head>
        
<body class="app flex-row align-items-center">
       
  <div class="container">
            
                          

    <div class="row justify-content-center">
      <div class="col-md-8 col-md-offset-2">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
                
                <div class="row">
                    
                    <div class="col-md-6"><h1>Login</h1></div>
                   @if(count($errors) > 0) 
                   @foreach ($errors->all() as $error)
                   <strong style="color: red">{{$error}}</strong>
                    @endforeach
                    @endif
                </div>

              <p class="text-muted">Sign In to your account</p>
              
              <form method="POST" action="{{route('post-login')}}">
                {{csrf_field()}}  
               

              
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

 
                <input autocomplete="off" name="primary_contact" type="text" class="form-control" placeholder="Enter phone number"> 



              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="fa fa-expeditedssl"></i></span>

   
                <input autocomplete="off" name="password" type="password" class="form-control" placeholder="4 Digit Pincode"> 


              </div>
              <div class="row">
                <div class="col-6">
                 
                    <button  type="submit"  class="btn btn-primary px-4">Login</button>
                </div> 
                <div class="col-6 text-right">
                <a style="text-decoration:none;color: black;"  class="btn btn-link px-0" href="{{route('password.email')}}">Forgot Password?</a>
                     <a href="{{route('home-view')}}" style="text-decoration:none;color: black;"  class="btn btn-link px-0" href="">New Member? Sign Up</a>
                
                </div>
              </div>
              
            </form>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
              <h2>AkokoTakra v2.0</h2> 
                <p>(Poultry Management System) </p>   
                <p>The poultry's farmer best friend... </p>
                </br>
                     
                <a style="margin-bottom :22px;" class="btn btn-secondary"  href="{{route('home-view')}}"><span class="">&nbsp&nbsp</span>Powered by: AgroInnova Ghana
                  </br>
                 <span class="fa fa-phone">&nbsp&nbsp</span>:(233 249 98 58 04)
              </a> 
                
                
              
            


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

     

</body>
               
    
</html>