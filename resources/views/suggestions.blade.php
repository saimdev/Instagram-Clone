<?php

?>
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
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Satisfy&display=swap" rel="stylesheet">
    <title>Instagram Clone</title>
</head>
<body>
    <div class="container-fluid">

        {{-- Left MENU --}}

        <div class="row">
            <div class="col col-2 menu container-fluid d-flex flex-column justify-content-start align-items-start p-4" style="background: linear-gradient(0.90turn, rgba(81, 91, 212, 0.5),rgba(129, 52, 175, 0.5),rgba(221, 42, 123, 0.5), rgba(245, 133, 41, 0.5), rgba(254, 218, 119, 0.5));
            backdrop-filter: blur(0px) saturate(5%); height:100vh; border-radius:0 0.5rem 0.5rem 0;" >
                <h3 class="h3 fw-normal text-white text-center my-4" style="margin-bottom:30px;font-family: 'Satisfy', cursive; margin-bottom: 1.3rem;">Instagram</h3>
                <a href="/newsfeed/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/home.svg')}}" alt=""> Home</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/search.svg')}}" alt=""> Search</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/navigation.svg')}}" alt=""> Explore</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/facebook-messenger.svg')}}" alt=""> Messages</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/heart.svg')}}" alt=""> Notifications</a>
                <a href="/editprofile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/add.svg')}}" alt=""> Create</a>
                @if ($dp==0)
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/blank.webp')}}" alt="" style="clip-path:circle();  width: 30px; margin-left:-0.2rem;"> Profile</a>
                @else
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/Bestie.png')}}" alt="" style="clip-path:circle();  width: 40px; margin-left:-0.5rem;"> Profile</a>
                @endif
                <a href="/logout" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/menu-burger.svg')}}" alt=""> Logout</a>
            </div>


            {{-- Mid Area --}}


            <div class="col col-10 d-flex align-items-center justify-content-center flex-column text-white" style="">
                <h4 class="h4 mb-3">Suggestions For You</h4>
                <div class="p-4" style="border:none; border-radius:0.5rem;background: rgba(128, 128, 128, 0.2);
                backdrop-filter: blur(25px) saturate(100%);">
                    @if (count($users)==0)
                        <h4 class="h4">No Users Found For Suggestion</h4>
                    @else
                        @foreach ($users as $user)
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div class="d-flex align-items-center">
                                    @if ($dp==0)
                                        <img class="suggestion-image" src="{{asset('/imgs/users/blank.webp')}}" alt="">
                                    @else
                                        <img class="suggestion-image" src="{{asset('/imgs/users/'.$user->username.'.jpg')}}" alt="">
                                    @endif
                                    <div class="d-flex flex-column" style="padding-right: 20rem">
                                        <a href="/{{$username}}/user/{{$user->username}}" class="text-white text-decoration-none"><p class="fw-bold" style="font-size: 0.8rem">{{$user->username}}</p></a>
                                        <p class="" style="color:gray; font-size: 0.8rem">{{$user->name}}</p>
                                    </div>
                                </div>
                                <a href="/{{$username}}/follow/{{$user->username}}" class="text-white border-0 text-decoration-none p-2" style="border-radius:0.4rem; font-size:0.9rem; background: #0d6efd">Follow</a>
                            </div>
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-primary w-100 mt-4">Get Started</button>
                </div>
            </div>

        </div>
    </div>
</body>
</html>