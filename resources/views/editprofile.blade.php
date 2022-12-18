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
<body style="height: 100vh">
    <div class="container-fluid">

        {{-- Left MENU --}}

        <div class="row">
            <div class="col col-2 menu container-fluid d-flex flex-column justify-content-start align-items-start p-4" style="background: linear-gradient(0.90turn, rgba(81, 91, 212, 0.5),rgba(129, 52, 175, 0.5),rgba(221, 42, 123, 0.5), rgba(245, 133, 41, 0.5), rgba(254, 218, 119, 0.5));
            backdrop-filter: blur(0px) saturate(5%); border-radius:0 0.5rem 0.5rem 0;" >
                <h3 class="h3 fw-normal text-white text-center my-4" style="margin-bottom:30px;font-family: 'Satisfy', cursive; margin-bottom: 1.3rem;">Instagram</h3>
                <a href="/newsfeed/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/home.svg')}}" alt=""> Home</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/search.svg')}}" alt=""> Search</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/navigation.svg')}}" alt=""> Explore</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/facebook-messenger.svg')}}" alt=""> Messages</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/heart.svg')}}" alt=""> Notifications</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/add.svg')}}" alt=""> Create</a>
                @if ($dp==0)
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/blank.webp')}}" alt="" style="border-radius: 100px; width: 25px;"> Profile</a>
                @else
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/'.$username.'.jpg')}}" alt="" style="border-radius: 100px; width: 25px;"> Profile</a>
                @endif
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/menu-burger.svg')}}" alt=""> Logout</a>
            </div>


            {{-- Mid Area --}}


            <div class="col col-10 d-flex align-items-center justify-content-center flex-column text-white" style="">
                <div class="p-5 my-5" style="border:none; border-radius:0.5rem;background: rgba(128, 128, 128, 0.2);
                backdrop-filter: blur(25px) saturate(100%);">
                    <form action="updateprofile/{{$username}}" method="post" style="backdrop-filter: none; background:none; border:none;" enctype="multipart/form-data">
                        @csrf
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-center flex-column text-white">
                            <div class="d-flex align-items-center">
                                @if ($dp==0)
                                <img src="{{asset('imgs/users/blank.webp')}}" style="width: 5rem; border-radius: 5rem;" alt="">
                            @else
                                <img src="{{asset('/imgs/users/'.$username.'.jpg')}}" style="width: 5rem; border-radius: 5rem;" alt="">
                            @endif
                            <div class="d-flex flex-column justify-content-center mx-4">
                                <p style="margin-left:0.5rem;">{{$data[0]['username']}}</p>
                                @if ($data[0]['profilepicture']=='0')
                                    <label for="" class="mt-2" style="margin-left:0.5rem;font-size: 0.8rem; color:#0d6efd;">Upload Profile Picture</label>
                                    <a href=""><input type="file" name="image"></a>
                                @else
                                    <label for="" class="mt-2" style="margin-left:0.5rem;font-size: 0.8rem; color:#0d6efd;">Change Profile Picture</label>
                                    <input type="file" name="image" style="">
                                    <a href="" class="text-danger text-decoration-none" style="margin-left:0.5rem; font-size: 0.7rem;">Remove Profile Picture</a>
                                @endif
                            </div>
                            </div>
                            <div class="row my-3 mt-4 d-flex align-items-center">
                                <div class="col col-3 d-flex justify-content-end" >
                                    <label for="" style="margin-right: 2rem; font-size:0.9rem">Name</label>
                                </div>
                                <div class="col col-9 d-flex justify-content-start">
                                    <input class="editinput w-100" type="text" name="name" value="{{$data[0]['name']}}" id="">
                                </div>
                                
                            </div>
                            <p class="mb-3" style=" margin-left:8.2rem;font-size: 0.7rem; color: gray">Help people discover your account by using the name <br>you're known by: either your full name, nickname, or <br> business name.</p>
                            <p class="" style=" margin-left:8.2rem;font-size: 0.7rem; color: gray">You can only change your name twice within 14 days.</p>
                            <div class="row my-3 d-flex align-items-center">
                                <div class="col col-3 d-flex justify-content-end">
                                    <label for="" style="margin-right: 2rem; font-size:0.9rem">Username</label>
                                </div>
                                <div class="col col-9 d-flex justify-content-start">
                                    <input class="editinput w-100" type="text" name="username" value="{{$data[0]['username']}}" id="">
                                </div>
                            </div>
                            <p class="mb-3" style=" margin-left:8.2rem;font-size: 0.7rem; color: gray">In most cases, you'll be able to change your username <br> back to kia_yar_rishi_bhai for another 14 days. <a href="" class="text-decoration-none" style="font-size: 0.7rem">Learn more</a></p>
                            @if ($data[0]['website']=='0')
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Website</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="website" placeholder="Website" id="">
                                    </div>
                                </div>
                            @else
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Website</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="website" value="{{$data[0]['website']}}" id="">
                                    </div>
                                </div>
                            @endif
                            <p class="mb-3" style=" margin-left:8.2rem;font-size: 0.7rem; color: gray">Editing your links is only available on mobile. Visit the Instagram <br> app and edit your profile to change the websites in your bio.</a></p>
                            @if ($data[0]['bio']=='0')
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Bio</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <textarea class="w-100" style="border-radius: 0.3rem !important;
                                        padding: 0.3rem 0.5rem !important;
                                        font-size: 0.9rem;" name="bio" id="" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            @else
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Bio</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <textarea name="bio" id="" cols="30" rows="10">{{$data[0]['bio']}}</textarea>
                                    </div>
                                </div>
                            @endif
                            <p class="fw-bold" style=" margin-left:8.2rem;font-size: 0.7rem; color: gray">Personal Information</p>
                            <p class="mb-3" style=" margin-left:8.2rem;font-size: 0.7rem; color: gray">Provide your personal information, even if the account is used for a <br> business, a pet or something else. This won't be a part of your <br> public profile.</p>
                            @if ($data[0]['email']=='0')
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Email</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="email" placeholder="Email" id="">
                                    </div>
                                </div>
                            @else
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Email</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="email" value="{{$data[0]['email']}}" id="">
                                    </div>
                                </div>
                            @endif
                            @if ($data[0]['phone']=='0')
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Phone</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="phone" placeholder="Phone" id="">
                                    </div>
                                </div>
                            @else
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Phone</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="phone" value="{{$data[0]['phone']}}" id="">
                                    </div>
                                </div>
                            @endif
                            @if ($data[0]['gender']=='0')
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Gender</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="gender" placeholder="Gender" id="">
                                    </div>
                                </div>
                            @else
                                <div class="row my-3 d-flex align-items-center">
                                    <div class="col col-3 d-flex justify-content-end">
                                        <label for="" style="margin-right: 2rem; font-size:0.9rem">Gender</label>
                                    </div>
                                    <div class="col col-9 d-flex justify-content-start">
                                        <input class="editinput w-100" type="text" name="gender" value="{{$data[0]['gender']}}" id="">
                                    </div>
                                </div>
                            @endif
                            <a href="" class="mb-2 text-decoration-none" style="margin-left:8.2rem; font-size: 0.8rem">Disable your account</a>
                            <button type="submit" class="btn btn-primary w-25" style="margin-left:8.2rem; font-size: 0.9rem">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>
</html>