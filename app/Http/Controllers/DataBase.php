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
                $table->string('comments',20);
                $table->string('likes',20);
            });

            DB::insert("insert into `insta_users` (`id`, `username`, `name`, `email`, `posts`, `followers`, `following`, `profilepicture`, `website`, `bio`, `phone`, `gender`) values (NULL,'".$username."', '".$name."', '".$email."', '0','0','0','0', '0', '0', '0', '0')");

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
        $data=InstaUser::all();
        return view('profile', ['details'=>$data])->with('username', $username)->with('count', $this->count)->with('dp', $this->dp);
    }

    function editProfile($username){
        $this->checkCount($username);
        $data = InstaUser::where('username', $username)->get();
        return view('editprofile', ['data'=>$data])->with('username', $username)->with('dp', $this->dp);
    }

    function updateProfile($username){
        
    }

}
