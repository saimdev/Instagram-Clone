<?php
    $postcount=0;
    foreach ($profile as $post) {
        $postcount=$postcount+1;
    }
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
        <div class="row">
            <div class="col col-2 menu container-fluid d-flex flex-column justify-content-start align-items-start p-4" style="background: linear-gradient(0.90turn, rgba(81, 91, 212, 0.5),rgba(129, 52, 175, 0.5),rgba(221, 42, 123, 0.5), rgba(245, 133, 41, 0.5), rgba(254, 218, 119, 0.5));
            backdrop-filter: blur(0px) saturate(5%); border-radius:0 0.5rem 0.5rem 0;">
                <h3 class="h3 fw-normal text-white text-center my-4" style="margin-bottom:30px;font-family: 'Satisfy', cursive; margin-bottom: 1.3rem;">Instagram</h3>
                <a href="/newsfeed/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/home.svg')}}" alt=""> Home</a>
                <a href="" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/search.svg')}}" alt=""> Search</a>
                <a href="" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/navigation.svg')}}" alt=""> Explore</a>
                <a href="" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/facebook-messenger.svg')}}" alt=""> Messages</a>
                <a href="" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/heart.svg')}}" alt=""> Notifications</a>
                <a href="/addnewpost/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/add.svg')}}" alt=""> Create</a>
                @if ($dp==0)
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/blank.webp')}}" alt="" style="clip-path:circle();  width: 30px; margin-left:-0.2rem;"> Profile</a>
                @else
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/'.$username.'.jpg')}}" alt="" style="clip-path:circle();  width: 30px; margin-left:-0.2rem;"> Profile</a>
                @endif
                <a href="/logout" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/menu-burger.svg')}}" alt=""> Logout</a>
            </div>
            <div class="col col-10 d-flex flex-column text-white py-5" style="padding-left: 7rem; padding-right:7rem">
                <div class="d-flex align-items-center justify-content-start mx-5">
                    <div class="mx-5">
                        @if ($dp==1)
                        <img src="{{asset('/imgs/users/blank.webp')}}" class="" alt="" style="width: 10rem; clip-path:circle(); margin-right:3rem">
                        @else
                        <img src="{{asset('/imgs/users/'.$frienduser.'.jpg')}}" class="" alt="" style="width: 10rem; height:11rem; clip-path:circle(); margin-right:3rem">
                        @endif
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center my-2">
                            <p class="mx-2">{{$details[0]['username']}}</p>
                            @if ($frndcheck==1)
                                <a href="/{{$username}}/unfollow/{{$frienduser}}" class="btn-primary mx-4 text-decoration-none py-1 px-3" style="border-radius: 0.5rem;">Unfollow</a>
                            @else
                                <a href="/{{$username}}/follow/{{$frienduser}}" class="btn-primary mx-4 text-decoration-none py-1 px-3" style="border-radius: 0.5rem;">Follow</a>
                            @endif
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <p class="mx-2">{{$details[0]['posts']}} posts</p>
                            <p class="mx-3">{{$details[0]['followers']}} followers</p>
                            <p class="mx-3">{{$details[0]['following']}} following</p>
                        </div>
                        <p class="fw-bold mt-2 mx-2">{{$details[0]['name']}}</p>
                        @if ($details[0]['bio']!='0')
                            <p class="mx-2" style="font-size: 0.9rem">{{$details[0]['bio']}}</p>
                        @endif
                        @if ($details[0]['website']!='0')
                            <a href="'www.'.{{$details[0]['website']}}" class="mx-2 text-decoration-none" style="font-size: 0.9rem">{{$details[0]['website']}}</a>
                        @endif
                    </div>
                </div>
                <div class="my-5 d-flex flex-row justify-content-center container-fluid flex-wrap" style="">
                    @if ($frndcount==0)
                        <h2 class="h2 fw-bold" style="padding:6rem 0;">No Post to Show</h2>
                    @else
                        @for ($i = 0; $i < $postcount; $i++)
                            <div class="profile-post">
                                <a href="/{{$username}}/post/{{$frienduser}}/{{$frienduser}}_post_{{$i+1}}/{{$frienduser}}_post_{{$i}}" class="text-white">
                                <img src="{{asset('/imgs/users/'.$frienduser.'/'.$frienduser.'_post_'.$i.'.jpg')}}" alt="" class="p-3 post-image" height="400rem" width="270rem" style="border-radius: 1.5rem;">
                                <div class="edit">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column align-items-center mx-1">
                                            <img src="{{asset('/imgs/logos/heart-fill.svg')}}" alt="" class="hover-icon">
                                            @foreach ($profile as $item)
                                                @if ($item->post==$frienduser.'_post_'.($i))
                                                    <p>{{$item->likes}}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="d-flex flex-column align-items-center mx-5">
                                            <img src="{{asset('/imgs/logos/comment-alt-middle2.svg')}}" alt="" class="hover-icon">
                                            @foreach ($profile as $item)
                                                @if ($item->post==$frienduser.'_post_'.($i))
                                                    <p>{{$item->comments}}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endfor
                    @endif
                </div>
                <div class="row footer mt-4">
                    <div class="col col-12 d-flex justify-content-between footer-links flex-wrap">
                        <a href="">Meta</a>
                        <a href="">About</a>
                        <a href="">Blog</a>
                        <a href="">Jobs</a>
                        <a href="">API</a>
                        <a href="">Privacy</a>
                        <a href="">Terms</a>
                        <a href="">Top Accounts</a>
                        <a href="">Hashtags</a>
                        <a href="">Locations</a>
                        <a href="">Instagram Lite</a>
                        <a href="">Contact</a>
                        <a href="">Uploading & Non-Users</a>
                    </div>
                </div>
                <div class="row copyright">
                    <div class="col d-flex justify-content-center mt-4">
                        <span>&copy; 2022 Instagram Clone from Saim</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>