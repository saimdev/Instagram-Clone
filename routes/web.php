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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[DataBase::class, 'login']);
Route::view('signup', 'signup');
Route::post('register', [DataBase::class, 'signup']);
Route::view('emailsignup', 'addbirthday');
Route::post('registration/{name}/{email}/{username}/{password}', [DataBase::class, 'registration']);
Route::get('/send-mail/{email}/{code}/', [DataBase::class, 'index']);
Route::get('/send-mail/{email}/confirm/{code}', [DataBase::class, 'confirmAccount']);
// Route::get('firstime', [DataBase::class, 'showusers']);
Route::view('newsfeed', 'newsfeed');
Route::get('profile/{username}', [DataBase::class, 'showProfile']);
Route::get('editprofile/{username}', [DataBase::class, 'editProfile']);
Route::get('updateprofile/{username}', [DataBase::class, 'updateProfile']);