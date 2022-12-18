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
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy&display=swap" rel="stylesheet">
    <title>Instagram Clone</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row login">
            <div class="col col-3"></div>
            <div class="col col-3 logo">
                <img src="{{ asset('imgs/logo.png') }}" class="logo-img" alt="">
            </div>
            <div class="col col-4">
                <form class="p-5" action="login" method="GET">
                    <h1 class="h1 fw-normal text-white text-center" style="font-family: 'Satisfy', cursive; margin-bottom: 2rem;">Instagram</h1>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Phone number, username, or email" aria-describedby="emailHelp" required>
                      
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" id="exampleInputPassword1" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Log in</button>
                        @if(session()->has('message'))
                            <div class="alert alert-danger error-message text-center" style="background: transparent; font-size:0.8rem; margin-top:0.4rem; border:none; color:rgb(237, 73, 86)">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    <div class="strike my-3">
                        <span>OR</span>
                     </div>
                     <div class="container text-center d-flex justify-content-center my-4">
                         <a href="https://www.facebook.com" target="_blank"><img src="{{asset('/imgs/logos/facebook.png')}}" alt="" style="width:20px; margin-right:10px;"></a>
                         <a href="https://www.facebook.com" style="font-size: 0.8rem;
                         color: #0d6efd;
                         text-decoration: none; margin-top:5px">Log in with Facebook</a>
                     </div>
                     <a href="" class="text-center d-flex justify-content-center" style="font-size: 0.8rem;
                     color: gray;
                     text-decoration: none; margin-top:5px">Forgot Password?</a>
                  </form>
                  <div class="row bottom">
                    <div class="col col-12">
                        <div class="signup d-flex justify-content-center p-3 align-items-center">
                            <p>Don't have an account? <a href="signup" style="text-decoration: none; font-size: 0.9rem;">Sign up</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-2"></div>
        </div>

        @component('components.footer')
        @endcomponent
        
    </div>
</body>
</html>