<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController')->name('home');

Route::post('profile/change', 'UsersController@update')->name('profile.change');
Route::resource('profile', 'UsersController')->only(['index']);

Route::get('auth/redirect/{provider}', 'SocialController@redirect')->name('social.redirect');
Route::get('callback/{provider}', 'SocialController@callback')->name('social.callback');

Route::get('comments/{routename}', 'CommentsController@index')->name('comments.index');
Route::post('comments', 'CommentsController@store')->name('comments.store');

Route::post('replies', 'RepliesController@store')->name('replies.store');
Route::get('replies/{commentId}', 'RepliesController@index')->name('replies.index');
