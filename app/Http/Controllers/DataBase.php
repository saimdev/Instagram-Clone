<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\InstaUser;
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
        if($check!=0){
            // return redirect('/newsfeed'); 
            return view('newsfeed');
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

            DB::insert("insert into `insta_users` (`id`, `username`, `name`, `email`, `posts`, `followers`, `following`, `profilepicture`, `website`, `bio`, `phone`, `gender`) values (NULL,'".$username."', '".$name."', '".$email."', 0, 0, 0,'0', '0', '0', '0', '0')");

            $path = public_path('imgs/users/'.$username."/");

            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            $random_code = rand(10000,99999);
            return redirect('send-mail/'.$email.'/'.Crypt::encrypt($random_code).'/');
        }catch(Exception $e){
            return redirect()->back()->with('phone_email',$e->getMessage());
        }
        return redirect('/');
    }

    public function index($email, $code)
    {
        $mailData = [
            'title' => 'Mail From Instagram Clone',
            'body' => 'Hi,
            Someone tried to sign up for an Instagram account with '.$email.'. If it was you, enter this confirmation code in the app: '.Crypt::decrypt($code)
        ];
         
        Mail::to($email)->send(new SendMail($mailData));
           
        return view('confirmationAccount')->with('email', $email)->with('code', $code);
    }

    function confirmAccount(Request $req, $email, $code){
        if ($req->code==Crypt::decrypt($code)){
            $data = User::where('email', '!=' ,$email)->get();
            
            $user = DB::table('users')->where('email', $email)->get();
            foreach($user as $item){
                $username = $item->username;
            }
            $this->checkCount($username);
            // echo $data;
            return view('firstime', ['users' => $data])->with('username', $username)->with('dp', $this->dp);
        }
        else{
            return redirect()->back()->with('phone_email', "Incorrect Confirmation Code");
        }
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

    function showProfile($username){
        $this->checkCount($username);
        $data=InstaUser::where('username', $username)->get();
        $profile = DB::select("SELECT * from `".$username."`");
        // echo $data;
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
                DB::update("UPDATE `insta_users` SET `profilepicture` = '".$profilepicture."'");
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
            DB::update("UPDATE `insta_users` SET `posts` = ".$postNo);
            
            $caption = $req->caption;
            
            if($req->filled('location')){
                $location=$req->location;
            }
            else{
                $location='';
            }
            DB::insert("INSERT INTO `notyoursaim`(`id`, `post`, `comments`, `likes`, `location`, `like`, `caption`) VALUES (NULL,'".$path.$image_name.'/'."',0 ,0 ,'".$location."',0 ,'".$caption."')");
            return redirect()->back()->with('success', 'Successfully Posted');
        } catch (Throwable $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
        
    }

}
