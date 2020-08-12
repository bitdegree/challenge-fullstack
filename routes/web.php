<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->name('home');

Auth::routes();
Route::get('login/{provider}', 'Auth\SocialController@redirectToProvider')->name('social.login');
Route::get('login/{provider}/callback', 'Auth\SocialController@handleProviderCallback');
Route::post('create-post', 'PostController@create')->middleware('can:create,App\Post');
Route::get('post-list/{allPosts}', 'PostController@list');
Route::get('post/{post}', 'PostController@show');
Route::get('destroy/{post}', 'PostController@destroy');
Route::get('post-children/{parent}', 'PostController@getPostChildren');
