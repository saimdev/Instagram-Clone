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
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('/app.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy&display=swap" rel="stylesheet">
    <title>Instagram Clone</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row login">
            <div class="col col-4"></div>
            <div class="col col-4">
                <form class="py-4 px-5" action="/confirm/{{$email}}/{{$code}}/{{$username}}" method="GET">                  
                    <span class="d-flex justify-content-center">
                        <img class="bd-image" src="{{asset('/imgs/logos/mail.png')}}" alt="" style="">
                    </span>
                    <h6 class="h6 fw-normal text-center my-3 text-white">Enter Your Confirmation Code</h6>
                    <span style="color: rgb(142, 142, 142); font-size: 0.8rem;" class="text-center d-flex justify-content-center flex-column">Enter the confirmation code we sent to {{$email}}</span>
                      <span style="color: rgb(142, 142, 142); font-size: 0.8rem;" class="text-center d-flex justify-content-center flex-column mb-2"><a href="#" style="text-decoration: none; font-size:0.8rem;font-weight:600;">Resend Code</a></span>
                      @if (session('phone_email'))
                              <div class="alert alert-danger error-message text-center" style="padding:0;background: transparent; font-size:0.8rem; margin-bottom:0.7rem; border:none; color:rgb(237, 73, 86)">{{ session('phone_email') }}</div>
                         @endif
                    <input type="number" name="code" style="margin-top: 1.5rem" id="form1Example2" class="form-control" />
                    <button type="submit" class="btn btn-primary w-100 mt-2 mb-2">Verify</button>
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