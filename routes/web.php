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
Route::view('cutie', 'cutie');
Route::view('cutieadd', 'cutieadd');
Route::view('projects', 'cutieprojects');
Route::view('addproject', 'addprojects');
Route::view('cutieprofile', 'cutieprofile');