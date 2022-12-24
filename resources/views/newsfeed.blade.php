<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('/app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
            backdrop-filter: blur(0px) saturate(5%); border-radius:0 0.5rem 0.5rem 0;" >
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


            {{-- Mid Area --}}


            <div class="col col-7" style="padding:60px 100px 60px 100px;">


                {{-- Upper Stories --}}

                <div class="container-fluid d-flex justify-content-between" style="border: 1px solid rgba(128, 128, 128, 0.1);
                border-radius: 0.5rem;
                background: rgba(128, 128, 128, 0.2);
                backdrop-filter: blur(25px) saturate(100%);">
                <div class="stories p-2">
                    <img src="{{asset('/imgs/users/Bestie.png')}}" class="stories-profile my-1" alt="">
                    <p style="font-size: 0.6rem; margin-bottom:0; color:white;" class="text-center">notyoursaim</p>
                </div>
                <div class="stories p-2">
                    <img src="{{asset('/imgs/users/Bestie.png')}}" class="stories-profile my-1" alt="">
                    <p style="font-size: 0.6rem; margin-bottom:0; color:white;" class="text-center">notyoursaim</p>
                </div>
                <div class="stories p-2">
                    <img src="{{asset('/imgs/users/Bestie.png')}}" class="stories-profile my-1" alt="">
                    <p style="font-size: 0.6rem; margin-bottom:0; color:white;" class="text-center">notyoursaim</p>
                </div>
                <div class="stories p-2">
                    <img src="{{asset('/imgs/users/Bestie.png')}}" class="stories-profile my-1" alt="">
                    <p style="font-size: 0.6rem; margin-bottom:0; color:white;" class="text-center">notyoursaim</p>
                </div>
                <div class="stories p-2">
                    <img src="{{asset('/imgs/users/Bestie.png')}}" class="stories-profile my-1" alt="">
                    <p style="font-size: 0.6rem; margin-bottom:0; color:white;" class="text-center">notyoursaim</p>
                </div>
            </div>


            @php
                $j=0;    
            @endphp
                @foreach ($postNames as $post)
                <div class="container-fluid my-3 text-white w-100" style="border: 1px solid rgba(128, 128, 128, 0.1);
                border-radius: 0.5rem;
                background: rgba(128, 128, 128, 0.2);
                backdrop-filter: blur(25px) saturate(100%); padding-left:0; padding-right:0;">
                    @for ($i = 0; $i < count($friendnames); $i++)
                        @if ($contains = Str::contains($post, $friendnames[$i]))
                            <div class="upperPost d-flex align-items-center p-3 w-100">
                                @if ($dps[$i]!='0')
                                    <img src="{{asset('/imgs/users/'.$friendnames[$i].'.jpg')}}" class="rightside-profile" alt="" style="margin-right:10px;">
                                @else
                                    <img src="{{asset('/imgs/users/blank.webp')}}" class="rightside-profile" alt="" style="margin-right:10px;">
                                @endif
                                <div class="w-100 d-flex align-items-center">
                                    <a href="/{{$username}}/user/{{$friendnames[$i]}}"style="font-size: 0.7rem; margin-bottom:0;" class="w-100 text-white text-decoration-none"><p>{{$friendnames[$i]}}</p></a>
                                    <img src="{{asset('/imgs/logos/menu-dots.svg')}}" alt="" class="menu-dots" style="margin-left: 65%;">
                                </div>
                            </div>
                            <div class="real-post">
                                <img src="{{asset('/imgs/users/'.$friendnames[$i].'/'.$post.'.jpg')}}" alt="" width="100%" height="100%">
                            </div>
                            <div class="lowerpost d-flex flex-column container-fluid p-3 ">
                                <div class="operations d-flex align-items-center w-100">
                                    <a href="/likepost/{{$username}}/{{$friendnames[$i]}}/{{$post}}"><img class="operation-icon" src="{{asset('/imgs/logos/heart.svg')}}" alt=""></a>
                                    <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/comment.svg')}}" alt=""></a>
                                    <div class="w-100 d-flex align-items-center">
                                        <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/paper-plane.svg')}}" alt=""></a>
                                        <a href="" style="margin-left: 78%;"><img class="operation-icon" src="{{asset('/imgs/logos/bookmark.svg')}}" style="margin-left: 100%;" alt=""></a>
                                    </div>
                                </div>
                                <div class="views w-100 container-fluid p-0 d-flex justify-content-start">
                                    <p class="py-0 my-2">{!! ($likes[$j][0]->likes) !!} likes</p>
                                </div>
                                <div class="caption container-flui p-0 w-100 d-flex  align-items-center my-1">
                                    <p class="py-0" style="margin-right: 2%">{{$friendnames[$i]}}</p>
                                    <p class="py-0 fw-lighter" style="font-size:0.9rem;">{!! ($captions[$j][0]->caption) !!}</p>
                                </div>
                                <div class="viewcomments container-flui p-0 w-100 d-flex flex-column justify-content-center">
                                    {{-- <input type="button" class="py-0 fw-bold comment-button" style="font-size: 0.8rem; color:gray" value="View all comments" /> --}}
                                    <button class="btn view-comments w-50" style="font-size: 0.8rem; color:gray">View all Comments</button>
                                        <script type="text/javascript">
                                            $("button").click(function(){
                                                if ($(this).text() == "View all Comments") {
                                                    $("#example").css('display', 'block');
                                                    $(this).css('display', 'none');
                                                }else{
                                                    $("#example").css('display', 'none');
                                                    $(this).text('View all Comments');
                                                }
                                            });
                                        </script>
                                    <div class="" id="example" style="display:none !important;">
                                        @for ($k = 0; $k < count($comments); $k++)
                                                <div class="d-flex align-items-center my-2">
                                                    <img src="{{asset('/imgs/users/Bestie.png')}}" alt="" style="clip-path:circle();" width="35px">
                                                    <div class="d-flex align-items-center" style="">
                                                        <p class="" style="font-size: 0.9rem; margin-left:0.9rem; ">notyoursaim <span style="font-size: 0.8rem; color:gray; margin-left:0.2rem;">Hello</span></p>
                                                    </div>
                                                </div>
                                        @endfor
                                    </div>
                                    <p class="py-0 my-2" style="color: gray; font-size:0.7rem">Recent Post</p>
                                </div>
                                <form action="/commentonpost/{{$friendnames[$i]}}/{{$post}}/{{$username}}" method="post" style="border: none;
                                border-radius: none;
                                background: none;
                                backdrop-filter: none;">
                                @csrf
                                    <div class="comment container-flui p-0 w-100 d-flex  align-items-center my-1">
                                        <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/smile.svg')}}" alt=""></a>
                                        <input class="w-100" name="comment" type="text" placeholder="Add a comment" style="flex-grow: 2">
                                        <input type="submit" value="Post">
                                    </div>
                                </form>
                            </div>
                            @break    
                        @endif
                    @endfor
                </div>
                @php
                    $j++;    
                @endphp
                @endforeach
            </div>



            {{-- Right MENU --}}



            <div class="col col-3 p-4 text-white" style="border-radius:0.5rem 0rem 0 0.5rem;">
                <div class="">
                    <div class="row d-flex flex-row justify-content-center align-items-center" style="margin-top: 40px;">
                        @if ($dp=='0')
                            <div class="col col-3 "><img src="{{asset('/imgs/users/blank.webp')}}" class="newsfeed-profile" alt=""></div>
                        @else
                            <div class="col col-3 "><img src="{{asset('/imgs/users/'.$username.'.jpg')}}" class="newsfeed-profile" alt=""></div>
                        @endif
                        <div class="col col-6"><div class="profile-names d-flex flex-column w-100" style="margin-right: 20px">
                            <a href="/profile/{{$username}}" class="text-white text-decoration-none"><p style="font-size: 0.8rem; margin-bottom:0; ">{{$username}}</p></a>
                            <p style="font-size: 0.8rem; color:gray;margin-bottom:0;">{{$name[0]['name']}}</p>
                        </div></div>
                        <div class="col col-3"><a href="/logout" style="text-decoration: none; font-size:0.8rem;">Switch</a></div>
                    </div>
                    <div class="row suggestions d-flex justify-content-center align-items-center" style="margin-top: 30px;">
                        <div class="col col-9">
                            <p style="font-size: 0.8rem; color:gray;margin-bottom:0;">Suggestions For You</p>
                        </div>
                        <div class="col col-3">
                            <a href="/suggestions/{{$username}}" style="text-decoration: none; font-size:0.8rem; color:white">See all</a>
                        </div>
                    </div>
                    @if (count($users)==0)
                        <h6 class="text-center my-2" style="font-size: 0.9rem; color:gray">No Users For Suggestions</h6>
                    @else
                        @foreach (array_slice($users, 0, 3) as $user)
                        <div class="row d-flex flex-row justify-content-center align-items-center" style="margin-top: 20px;">
                            <div class="col col-2 "><img src="{{asset('/imgs/users/'.$user->username.'.jpg')}}" class="rightside-profile" alt=""></div>
                            <div class="col col-7"><div class="profile-names d-flex flex-column" style="margin-right: 20px">
                                <a href="/{{$username}}/user/{{$user->username}}" class="text-white text-decoration-none"><p style="font-size: 0.7rem; margin-bottom:0;">{{$user->username}}</p>
                                    <p style="font-size: 0.7rem; color:gray;margin-bottom:0;">{{$user->name}}</p></a>
                            </div></div>
                            <div class="col col-3"><a href="/{{$username}}/follow/{{$user->username}}" style="text-decoration: none; font-size:0.7rem;">Follow</a></div>
                        </div>
                        @endforeach
                    @endif
                    
                    
                </div>
            </div>

        </div>
    </div>
</body>
</html>