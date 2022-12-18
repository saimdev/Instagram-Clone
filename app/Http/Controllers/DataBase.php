<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class DataBase extends Controller
{
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
        }catch(Exception $e){
            return redirect()->back()->with('phone_email',$e->getMessage());
        }
        return redirect('/');
    }
}
