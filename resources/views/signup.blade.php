<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('/app.js')}}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{asset('/app.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy&display=swap" rel="stylesheet">
    <title>Instagram Clone</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row login">
            <div class="col col-4"></div>
            <div class="col col-4">
                <form class="p-5" action="register" method="POST">
                    @csrf                    
                    <h1 class="h1 fw-normal text-white text-center" style="font-family: 'Satisfy', cursive; margin-bottom: 1.3rem;">Instagram</h1>
                    <h6 class="h6 fw-normal text-center" style="color: rgb(142, 142, 142); margin-bottom: 1.3rem;">Sign up to see photos and videos from your friends.</h6>
                    <button type="submit" class="btn btn-primary w-100"><a href="https://www.facebook.com" target="_blank"><img src="{{asset('/imgs/logos/facebook.png')}}" alt="" style="width:20px; margin-right:10px;"></a>
                        <a href="https://www.facebook.com" style="font-size:0.8rem; color: white; text-decoration: none; margin-top:5px">Log in with Facebook</a></button>
                        <div class="strike my-3">
                            <span>OR</span>
                         </div>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Email" aria-describedby="emailHelp" required>
                      
                    </div>
                    <div class="mb-3">
                      <input type="text" name="name" class="form-control" placeholder="Full Name" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="exampleInputPassword1" required>
                      </div>
                      @if (session('phone_email'))
                              <div class="alert alert-danger error-message text-center" style="padding:0;background: transparent; font-size:0.8rem; margin-bottom:0.7rem; border:none; color:rgb(237, 73, 86)">{{ session('phone_email') }}</div>
                         @endif
                      <span style="color: rgb(142, 142, 142); font-size: 0.8rem;" class="text-center d-flex justify-content-center flex-column">People who use our service may have uploaded your contact information to Instagram. <a href="#" style="text-decoration: none; font-size:0.8rem; color:rgb(142, 142, 142); font-weight:600;">Learn More</a></span>
                      <span style="color: rgb(142, 142, 142); font-size: 0.8rem;" class="text-center d-flex justify-content-center flex-column my-3">By signing up, you agree to our <a href="#" style="text-decoration: none; font-size:0.8rem; color:rgb(142, 142, 142); font-weight:600;">Terms , Privacy Policy and Cookies Policy</a></span>
                    <button type="submit" class="btn btn-primary w-100">Sign up</button>
                  </form>
                  <div class="row bottom">
                    <div class="col col-12">
                        <div class="signup d-flex justify-content-center p-3 align-items-center">
                            <p>Have an account? <a href="/" style="text-decoration: none; font-size: 0.9rem;">Log In</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-4"></div>
        </div>

        @component('components.footer')
        @endcomponent
        
    </div>
</body>
</html>