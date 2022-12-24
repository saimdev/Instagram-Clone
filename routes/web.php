<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBase;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/', 'welcome');
Route::view('signup', 'signup');
Route::post('register', [DataBase::class, 'signup']);
Route::view('emailsignup', 'addbirthday');
Route::post('registration/{name}/{email}/{username}/{password}', [DataBase::class, 'registration']);
Route::get('/send-mail/{email}/{code}/{username}', [DataBase::class, 'index']);
Route::get('confirm/{email}/{code}/{username}', [DataBase::class, 'confirmAccount']);
Route::view('firstime', 'firstime');
Route::get('login',[DataBase::class, 'login']);
Route::view('logout', 'welcome');



// Route::get('login',[DataBase::class, 'login']);
// Route::view('signup', 'signup');
// Route::post('register', [DataBase::class, 'signup']);
// Route::view('emailsignup', 'addbirthday');
// Route::post('registration/{name}/{email}/{username}/{password}', [DataBase::class, 'registration']);
// Route::get('/send-mail/{email}/{code}/', [DataBase::class, 'index']);
// Route::get('/send-mail/{email}/confirm/{code}', [DataBase::class, 'confirmAccount']);
// // Route::get('firstime', [DataBase::class, 'showusers']);
// Route::view('newsfeed', 'newsfeed');
// Route::get('profile/{username}', [DataBase::class, 'showProfile']);
// Route::get('editprofile/{username}', [DataBase::class, 'editProfile']);
// Route::post('editprofile/updateprofile/{username}', [DataBase::class, 'updateProfile']);
// Route::get('addnewpost/{username}', [DataBase::class, 'addnewpost']);
// Route::post('addnewpost/postpicture/{username}', [DataBase::class, 'postPicture']);
// Route::get('post/{username}/{postid}/{postsearchid}',[DataBase::class, 'showIndividualPost']);


// Route::get('firstime', [DataBase::class, 'showusers']);
Route::get('profile/{username}', [DataBase::class, 'showProfile']);
Route::get('editprofile/{username}', [DataBase::class, 'editProfile']);
Route::post('editprofile/updateprofile/{username}', [DataBase::class, 'updateProfile']);
Route::get('addnewpost/{username}', [DataBase::class, 'addnewpost']);
Route::post('addnewpost/postpicture/{username}', [DataBase::class, 'postPicture']);
Route::get('post/{username}/{postid}/{postsearchid}',[DataBase::class, 'showIndividualPost']);
Route::get('{username}/post/{frienduser}/{postid}/{postsearchid}',[DataBase::class, 'showUserPost']);
Route::get('{username}/user/{frienduser}', [DataBase::class, 'showuserprofile']);
Route::post('commentonpost/{friendname}/{postid}/{username}',[DataBase::class, 'commentonpost']);
Route::get('likepost/{username}/{friendname}/{postid}',[DataBase::class, 'likeonpost']);
Route::get('{username}/follow/{frienduser}', [DataBase::class, 'followuser']);
Route::get('{username}/unfollow/{frienduser}', [DataBase::class, 'unfollowuser']);
Route::get('newsfeed/{username}', [DataBase::class, 'showmainwall']);
Route::get('suggestions/{username}', [DataBase::class, 'suggestions']);