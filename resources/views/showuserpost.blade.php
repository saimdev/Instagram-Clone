
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
            backdrop-filter: blur(0px) saturate(5%); border-radius:0 0.5rem 0.5rem 0;" >
                <h3 class="h3 fw-normal text-white text-center my-4" style="margin-bottom:30px;font-family: 'Satisfy', cursive; margin-bottom: 1.3rem;">Instagram</h3>
                <a href="/newsfeed/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/home.svg')}}" alt=""> Home</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/search.svg')}}" alt=""> Search</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/navigation.svg')}}" alt=""> Explore</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/facebook-messenger.svg')}}" alt=""> Messages</a>
                <a href="/newsfeed" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/logos/heart.svg')}}" alt=""> Notifications</a>
                <a href="/addnewpost/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/add.svg')}}" alt=""> Create</a>
                @if ($dp==0)
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/blank.webp')}}" alt="" style="clip-path:circle();  width: 40px; margin-left:-0.5rem;"> Profile</a>
                @else
                <a href="/profile/{{$username}}" class="d-flex flex-row align-items-center justify-content-center menu-items my-4"><img src="{{asset('/imgs/users/'.$username.'.jpg')}}" alt="" style="clip-path:circle();  width: 40px; margin-left:-0.5rem;"> Profile</a>
                @endif
                <a href="/logout" class="d-flex flex-row align-items-center justify-content-center menu-items my-3"><img src="{{asset('/imgs/logos/menu-burger.svg')}}" alt=""> Logout</a>
            </div>


            {{-- Mid Area --}}


            <div class="col col-10 d-flex flex-column text-white py-5" style="padding-left: 7rem; padding-right:7rem">
                <div class="row w-100" style="border: 1px solid rgba(128, 128, 128, 0.1);
                border-radius: 0.5rem;
                background: rgba(128, 128, 128, 0.2);
                backdrop-filter: blur(25px) saturate(100%);">
                    <div class="col-6" style="padding: 0">
                        <img src="{{asset('/imgs/users/'.$frienduser.'/'.$postpath.'.jpg')}}" alt="" width="100%" height="100%" style="border-radius: 0.5rem 0 0 0.5rem;">
                    </div>
                    <div class="col-6 d-flex flex-column py-1 px-4">
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('/imgs/users/'.$frienduser.'.jpg')}}" alt="" style="clip-path:circle();  width: 40px;">
                                <div class="d-flex flex-column align-items-center" style="">
                                    <p class="" style="font-size: 0.9rem; margin-left:0.9rem;">{{$frienduser}}</p>
                                    @foreach ($collection as $item)
                                        <p style="font-size: 0.8rem; color:gray; margin-left:-0.8rem;">{{$item->location}}</p>
                                    @endforeach
                                </div>
                            </div>
                            <a href=""><img src="{{asset('/imgs/logos/menu-dots.svg')}}" alt="" class="menu-dots" style=""></a>
                        </div>
                        <hr>
                        @if ($postdata!=null)
                            <div class="d-flex flex-column comments" style="height: 15rem">                            
                                @foreach ($postdata as $postdetails)
                                    <div class="d-flex align-items-center my-2">
                                        <img src="{{asset('/imgs/users/'.$postdetails->frndusername.'.jpg')}}" alt="" style="clip-path:circle();" width="40px">
                                        <div class="d-flex align-items-center" style="">
                                            <p class="" style="font-size: 0.9rem; margin-left:0.9rem; ">{{$postdetails->frndusername}} <span style="font-size: 0.8rem; color:gray; margin-left:0.2rem;">{{$postdetails->comment}}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr style="margin-bottom: 0rem !important">
                            <div class="lowerpost d-flex flex-column container-fluid p-3 ">
                                <div class="operations d-flex align-items-center w-100">
                                    <a href=""><img class="operation-icon check-icon" src="{{asset('/imgs/logos/heart.svg')}}" alt=""></a>
                                    <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/comment.svg')}}" alt=""></a>
                                    <div class="w-100 d-flex align-items-center">
                                        <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/paper-plane.svg')}}" alt=""></a>
                                    </div>
                                </div>
                                <div class="views w-100 container-fluid p-0 d-flex justify-content-start">
                                    @foreach ($collection as $item)
                                        @if ($item->likes>1)
                                            <p class="py-0 my-2">{{$item->likes}} likes</p>
                                        @elseif ($item->likes==1)
                                            <p class="py-0 my-2">{{$item->likes}} like</p>
                                        @else
                                            <p class="py-0 my-2">No likes</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="caption container-flui p-0 w-100 d-flex  align-items-center my-1">
                                    <p class="py-0" style="margin-right: 2%">{{$username}}</p>
                                    @foreach ($collection as $item)
                                        <p class="py-0 fw-lighter" style="font-size:0.9rem;">{{$item->caption}}</p>
                                    @endforeach
                                </div>
                                <div class="viewcomments container-flui p-0 w-100 d-flex flex-column justify-content-center">
                                    <p class="py-0 my-2" style="color: gray; font-size:0.7rem">Recent post</p>
                                </div>
                                @foreach ($collection as $item)
                                    <form action="/commentonpost/{{$frienduser}}/{{$item->post}}/{{$username}}" method="post" style="border: none;
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
                                @endforeach
                            </div>
                        @else
                            <div class="d-flex flex-column ">                            
                                <div class="d-flex justify-content-center align-items-center my-2">
                                    <h4 class="h4 my-3">No Comments to Show</h4>
                                </div>
                            </div>
                            <hr style="margin-bottom: 0rem !important">
                            <div class="lowerpost d-flex flex-column container-fluid p-3 ">
                                <div class="operations d-flex align-items-center w-100">
                                    <a href=""><img class="operation-icon check-icon" src="{{asset('/imgs/logos/heart.svg')}}" alt=""></a>
                                    <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/comment.svg')}}" alt=""></a>
                                    <div class="w-100 d-flex align-items-center">
                                        <a href=""><img class="operation-icon" src="{{asset('/imgs/logos/paper-plane.svg')}}" alt=""></a>
                                    </div>
                                </div>
                                <div class="views w-100 container-fluid p-0 d-flex justify-content-start">
                                    @foreach ($collection as $item)
                                        @if ($item->likes>1)
                                            <p class="py-0 my-2">{{$item->likes}} likes</p>
                                        @elseif ($item->likes==1)
                                            <p class="py-0 my-2">{{$item->likes}} like</p>
                                        @else
                                            <p class="py-0 my-2">No likes</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="caption container-flui p-0 w-100 d-flex  align-items-center my-1">
                                    <p class="py-0" style="margin-right: 2%">{{$frienduser}}</p>
                                    @foreach ($collection as $item)
                                        <p class="py-0 fw-lighter w-100" style="font-size:0.9rem;">{{$item->caption}}</p>
                                    @endforeach
                                </div>
                                <div class="viewcomments container-flui p-0 w-100 d-flex flex-column justify-content-center">
                                    <p class="py-0 my-2" style="color: gray; font-size:0.7rem">Recent post</p>
                                </div>
                                @if (session('error'))
                              <div class="alert alert-danger error-message text-center" style="padding:0;background: transparent; font-size:0.8rem; margin-bottom:0.7rem; border:none; color:rgb(237, 73, 86)">{{ session('error') }}</div>
                            @endif
                                @foreach ($collection as $item)
                                    <form action="/commentonpost/{{$frienduser}}/{{$item->post}}/{{$username}}" method="post" style="border: none;
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
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>