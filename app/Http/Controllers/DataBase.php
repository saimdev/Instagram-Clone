<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\InstaUser;
use App\Models\AuthCheck;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Controllers\MailController;
use Mail;
use Crypt;
use App\Mail\SendMail;

class DataBase extends Controller
{
    public $count=0;
    public $dp=0;
    public $frndcount = 0;

    function login(Request $req){
        $req->validate([
          'email'=> 'required',
          'password'=>'required'  
        ]);
        $check=0;
        $email = $req->email;
        $password = $req->password;
        $data = DB::table('users')->where('email', $email)->where('password', $password)->get();
        $check = count($data);
        foreach($data as $user){
            $username = $user->username;
        }
        $this->checkCount($username);
        // $authcheck = AuthCheck::where('id', 1)->get();
        // echo $authcheck[0]['check'];
        if($check!=0){
            DB::table('auth_checks')
                ->where('id', 1)
                ->update(['check' => 1]);
            // return redirect('/newsfeed'); 
            return redirect('/newsfeed/'.$username);
        }
        else{
            return redirect()->back()->with('message', 'Sorry, your email or password was incorrect. Please double-check your credentials.');
        }
    }

    function signup(Request $req){
        
        try {
            $newuser = new User;
            $name = $req->name;
            $email = $req->email;
            $username = $req->username;
            $password = $req->password;
            $data = User::all();
            foreach($data as $user){
                if($user->email==$email){
                    return redirect()->back()->with('phone_email','Email Already Exists');
                }
                if($user->username==$username){
                    return redirect()->back()->with('phone_email','Username Already Exists');
                }
            }
        } catch(Exception $e){
               return redirect()->back()->with('phone_email',$e->getMessage());
           }
        return view('addbirthday')->with('name', $name)->with('name', $name)->with('username', $username)->with('email', $email)->with('password', $password);
    }

    function registration(Request $req, $name, $email, $username, $password){
        try {
            $newuser = new User;
            $newuser->name = $name;
            $newuser->email = $email;
            $newuser->username = $username;
            $newuser->password = $password;
            $newuser->bdmonth = $req->month;
            $newuser->bdday = $req->day;
            $newuser->bdyear = $req->year;
            $newuser->save();

            Schema::create($username, function (Blueprint $table) {
                $table->increments('id');
                $table->string('post',100);
                $table->integer('comments');
                $table->integer('likes');
                $table->string('location', 20);
                $table->integer('like');
                $table->text('caption');
            });

            Schema::create($username.'_followings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('frndusername', 30);
            });

            Schema::create($username.'_followers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('frndusername', 30);
            });

            DB::insert("insert into `insta_users` (`id`, `username`, `name`, `email`, `posts`, `followers`, `following`, `profilepicture`, `website`, `bio`, `phone`, `gender`) values (NULL,'".$username."', '".$name."', '".$email."', 0, 0, 0,'0', '0', '0', '0', '0')");

            $path = public_path('imgs/users/'.$username."/");

            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            $random_code = rand(10000,99999);
            return redirect('send-mail/'.$email.'/'.Crypt::encrypt($random_code).'/'.$username);
        }catch(Exception $e){
            return redirect()->back()->with('phone_email',$e->getMessage());
        }
        return redirect('/');
    }

    public function index($email, $code, $username)
    {
        $mailData = [
            'title' => 'Mail From Instagram Clone',
            'body' => 'Hi,
            Someone tried to sign up for an Instagram account with '.$email.'. If it was you, enter this confirmation code in the app: '.Crypt::decrypt($code)
        ];
         
        Mail::to($email)->send(new SendMail($mailData));
           
        return view('confirmationAccount')->with('email', $email)->with('code', $code)->with('username', $username);
    }

    function confirmAccount(Request $req, $email, $code, $username){
        if ($req->code==Crypt::decrypt($code)){
            $data = User::where('email', '!=' ,$email)->get();
            $followers = DB::select("select * from `".$username."_followings`");
            $data->toBase()->merge($followers);
            $checkD=0;
            $j=0;
            $emptyArray = []; 
            foreach($followers as $suggested){
                for($i=0; count($data); $i++){
                    if($suggested->frndusername!=$data[$i]['username']){
                        $checkD = 1;
                        $j=$i;
                    }
                    else{
                        $checkD = 0;
                        $j=0;
                    }
                }
                if($checkD==1){
                    $newData[]=$data[$j]['username'];
                }
                // echo $suggested->frndusername;
            }
            
            $user = DB::table('users')->where('email', $email)->get();
            foreach($user as $item){
                $username = $item->username;
            }
            $this->checkCount($username);
            // echo $data;
            DB::table('auth_checks')
                ->where('id', 1)
                ->update(['check' => 1]);
            dd($newData);
            // if($checkD==1){
            //     return view('firstime', ['users' => $newData])->with('username', $username)->with('dp', $this->dp);
            // }
            // else{
            //     return view('firstime', ['users' => $emptyArray])->with('username', $username)->with('dp', $this->dp);
            // }
        }
        else{
            return redirect()->back()->with('phone_email', "Incorrect Confirmation Code");
        }
    }

    function suggestions($username){
        $data = User::where('username', '!=' ,$username)->get();
        $followers = DB::select("select * from `".$username."_followings`");
        $data->toBase()->merge($followers);
        $this->checkCount($username);
        return view('suggestions', ['users'=>$data])->with('username', $username)->with('dp', $this->dp);
    }

    function checkCount($username){
        $data = InstaUser::where('username',$username)->get();
        
        if($data[0]['posts']=='0'){
            $this->count=0;
        }
        else{
            $this->count=1;
        }
        if($data[0]['profilepicture']=='0'){
            $this->dp=0;
        }
        else{
            $this->dp=1;
        }
    }

    function checkCountFriends($frnduser){
        $data = InstaUser::where('username',$frnduser)->get();
        
        if($data[0]['posts']=='0'){
            $this->frndcount=0;
        }
        else{
            $this->frndcount=1;
        }
    }

    function showProfile($username){
        $this->checkCount($username);
        $data=InstaUser::where('username', $username)->get();
        $profile = DB::table($username)->select('id', 'post', 'comments', 'likes', 'location', 'like', 'caption')->get();
        // echo $this->dp.'</br>';
        // echo $this->count;
        return view('profile', ['details'=>$data])->with('username', $username)->with('count', $this->count)->with('dp', $this->dp)->with('profile', $profile);
    }

    function editProfile($username){
        $this->checkCount($username);
        $data = InstaUser::where('username', $username)->get();
        return view('editprofile', ['data'=>$data])->with('username', $username)->with('dp', $this->dp);
    }

    function updateProfile(Request $req, $username){
        try {
            if($req->hasFile('image')){
                $image = $req->file('image');
                $image_name = $username.'.jpg';
                $image->move(public_path('/imgs/users'),$image_name);
                $profilepicture = "/imgs/users/".$image_name."/";
                DB::update("UPDATE `insta_users` SET `profilepicture` = '".$profilepicture."' where `username` = '".$username."'");
            }
    
            if($req->filled('website')){
                $website=$req->website;
            }
            else{
                $website='0';
            }
            if($req->filled('bio')){
                $bio=$req->bio;
            }
            else{
                $bio='0';
            }
            if($req->filled('phone')){
                $phone=$req->phone;
            }
            else{
                $phone='0';
            }
            if($req->filled('gender')){
                $gender=$req->gender;
            }
            else{
                $gender='0';
            }
    
            DB::update("UPDATE `insta_users` SET `website` = '".$website."', `bio` = '".$bio."', `phone` = '".$phone."', `gender` = '".$gender."'");
            return redirect()->back()->with('success', "Profile Saved");

        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
        
    }

    function addnewpost($username){
        $this->checkCount($username);
        return view('addnewpost')->with('username', $username)->with('dp', $this->dp);
    }

    function postPicture(Request $req, $username){

        try {
            $path = public_path('imgs/users/'.$username."/");

            $data = InstaUser::where('username', $username)->get();
            $postNo = $data[0]['posts'];

            Schema::create($username.'_post_'.$postNo, function (Blueprint $table) {
                $table->increments('id');
                $table->string('frndusername', 30);
                $table->text('comment');
            });


            // echo $data[0]['posts'];

            if($req->hasFile('image')){
                $image = $req->file('image');
                $image_name = $username.'_post_'.$postNo.'.jpg';
                $image->move($path, $image_name);
            }

            $postNo = $postNo+1;
            DB::update("UPDATE `insta_users` SET `posts` = ".$postNo." where `username` = '".$username."'");
            
            $caption = $req->caption;
            
            if($req->filled('location')){
                $location=$req->location;
            }
            else{
                $location='';
            }
            DB::insert("INSERT INTO `".$username."`(`id`, `post`, `comments`, `likes`, `location`, `like`, `caption`) VALUES (NULL,'". $username.'_post_'.$postNo."',0 ,0 ,'".$location."',0 ,'".$caption."')");
            return redirect()->back()->with('success', 'Successfully Posted');
        } catch (Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
        
    }

    function showIndividualPost($username, $postid, $postsearchid){
        $this->checkCount($username);
        $postData = DB::select("select * from `".$postsearchid."`");
        $data = DB::select("select * from `".$username."` where `post` = '".$postid."'");
        // dd($postData);
        // foreach($data as $item){
        //     echo $item;
        // }
        // dd($data);
        return view('showpost', ['collection' => $data])->with('postdata', $postData)->with('username', $username)->with('dp', $this->dp)->with('postpath', $postsearchid);
    }

    function showUserPost($username, $frienduser, $postid, $postsearchid){
        $this->checkCount($username);
        $postData = DB::select("select * from `".$postsearchid."`");
        $data = DB::select("select * from `".$frienduser."` where `post` = '".$postid."'");
        // dd($postData);
        // foreach($data as $item){
        //     echo $item;
        // }
        // dd($data);
        return view('showuserpost', ['collection' => $data])->with('postdata', $postData)->with('username', $username)->with('dp', $this->dp)->with('postpath', $postsearchid)->with('frienduser', $frienduser);
    }

    function showuserprofile($username, $frienduser){
        $this->checkCount($username);
        $this->checkCountFriends($frienduser);
        $checkfollower=0;
        $data=InstaUser::where('username', $frienduser)->get();
        $profile = DB::table($frienduser)->select('id', 'post', 'comments', 'likes', 'location', 'like', 'caption')->get();
        $frndprofile = DB::table($username.'_followings')->where('frndusername', $frienduser)->get();
        
        if($frndprofile->count()!=0){
            // dd($frndprofile);
            $checkfollower=1;
        }
        else{
            $checkfollower=0;
        }
        return view('showuserprofile', ['details'=>$data])->with('username', $username)->with('count', $this->count)->with('frndcount', $this->frndcount)->with('dp', $this->dp)->with('profile', $profile)->with('frndcheck', $checkfollower)->with('frienduser', $frienduser);
    }

    function followuser($username, $frienduser){
        DB::insert("insert into `".$username."_followings` (`id`, `frndusername`) values (NULL, '".$frienduser."')");
        DB::insert("insert into `".$frienduser."_followers` (`id`, `frndusername`) values (NULL, '".$username."')");
        $data = DB::select("select * from `insta_users` where `username` = '".$frienduser."'");
        $userdata = DB::select("select * from `insta_users` where `username` = '".$username."'");
        foreach($data as $user){
            $followers = $user->followers;
        }
        foreach($userdata as $user){
            $followings = $user->following;
        }
        $followers = $followers+1;
        $followings = $followings+1;
        DB::update("UPDATE `insta_users` SET `followers` = ".$followers." where `username` = '".$frienduser."'");
        DB::update("UPDATE `insta_users` SET `following` = ".$followings." where `username` = '".$username."'");
        return redirect()->back();
    }

    function unfollowuser($username, $frienduser){
        DB::delete("delete from `".$username."_followings` where `frndusername` = '".$frienduser."'");
        DB::delete("delete from `".$frienduser."_followers` where `frndusername` = '".$username."'");
        $data = DB::select("select * from `insta_users` where `username` = '".$frienduser."'");
        $userdata = DB::select("select * from `insta_users` where `username` = '".$username."'");
        foreach($data as $user){
            $followers = $user->followers;
        }
        foreach($userdata as $user){
            $followings = $user->following;
        }
        $followers = $followers-1;
        $followings = $followings-1;
        DB::update("UPDATE `insta_users` SET `followers` = ".$followers." where `username` = '".$frienduser."'");
        DB::update("UPDATE `insta_users` SET `following` = ".$followings." where `username` = '".$username."'");
        return redirect()->back();
    }

    function showmainwall($username){
        $this->checkCount($username);
        $followings = DB::select("select * from `".$username."_followings`");
        $userData = User::where('username', $username)->get('name');
        if($followings!=null){
            foreach($followings as $friend){
                $friendnames[] = $friend->frndusername;
            }
        
            // $posts = DB::select("select * from `".$username."`");
            foreach($friendnames as $friendpostCount){
                // $data = DB::select("select (`posts`) from `insta_users` where `username` = '".$friendpostCount."'");
                $postsCount[] =  InstaUser::where('username', $friendpostCount)->get('posts');
                // $postsCount[]=$data;
            }
            // echo $friendnames[1];
            $j=0;
            foreach($postsCount as $count){
                for($i=0; $i<$count[0]['posts']; $i++){
                    $postNames[]=$friendnames[$j].'_post_'.$i;
                }
                $j++;
            }

            foreach($friendnames as $friendpostCount){
                // $data = DB::select("select (`posts`) from `insta_users` where `username` = '".$friendpostCount."'");
                $dps[] =  InstaUser::where('username', $friendpostCount)->get('profilepicture');
                // $postsCount[]=$data;
            }

            shuffle($postNames);
            // foreach($postsCount as $count){
            //     echo $count[0]['posts'].'</br>';
            // }

            foreach($postNames as $post){
                $comments[] = DB::select("select * from `".$post."`");
            }

            // if($dps[0]!='0'){
            //     echo $dps[0].'</br>';
            // }
            // else{
            //     echo 'Hello';
            // }
            
            // dd($postNames);
            // echo $friendnames[0];
            // dd($comments);
            // foreach($posts as $postName){
            //     $noOfPosts[] = $postName->post;
            // }
            // foreach($postsCount as $count){
            //     echo $count[0]['posts'];
            // }
            
            // $arr = array(
            //     array(
            //         array(1,2 ,3)
            //     ),
            //     array(
            //         array(2,2,3)
            //     )
            // );
            // $result = json_decode($postsCount, true);
            // dd($postsCount);
            // for($i=0; $i<2; $i++){
            //     for($j=0; $j<1; $j++){
            //         for($k=0; $k<1; $k++){
            //             for($l=0; $l<1; $l++){
            //                 echo "[$i][$j][$k][$l] = ".$postsCount[$i][$j][$k][$l].'</br>';
            //             }
            //         }
            //     }   
            // }
            // foreach($postsCount as $random){
                // echo $random->[0][posts'];
            // }
        
            // echo $userData[0]['name'];
            return view('newsfeed')->with('postNames', $postNames)->with('comments', $comments)->with('friendnames', $friendnames)->with('dps', $dps)->with('username', $username)->with('dp', $this->dp)->with('name', $userData);
        }
        else{
            return view('newsfeed')->with('username', $username)->with('dp', $this->dp)->with('name', $userData);
        }
        
    }

    // function commentonpost(Request $req, $postid, $username, $postowner){

    // }

}
