<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'AuthController@register')->name("register");
Route::post('/login', 'AuthController@login')->name("login");
Route::post('/logout', 'AuthController@logout')->name("logout");
Route::post('/status', 'AuthController@status')->name("status");
Route::get('/login/failed', 'AuthController@failLogin')->name("failLogin");
Route::get('/comments', 'CommentController@index')->name("comments");
Route::post('/comments', 'CommentController@store')->name("comments_store");
Route::get("/comments/{id}", 'CommentController@viewReplies')->name("comments_replies");