<?php

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



Route::group(['middleware' => ['web']], function () {

  Route::get('/', function () {
      if (Auth::user()) {
        return redirect()->route('dashboard');
      }
      return view('vendor/welcome');
  })->name('home');

  Route::post('/signup', [
    'uses' => 'UserController@postSignUp',

    'as' => 'signup'
  ]);

  Route::post('/signin', [
    'uses' => 'UserController@postSignIn',

    'as' => 'signin'
  ]);

  Route::get('/dashboard', [
    'uses' => 'PostController@getDashboard',

    'as' => 'dashboard',

    'middleware' => 'guest'
  ]);

  Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',

    'as' => 'post.create',

    'middleware' => 'guest'

  ]);

  Route::get('/deletepost/{post_id}', [
    'uses' => 'PostController@getDeletePost',

    'as' => 'post.delete',

    'middleware' => 'guest'

  ]);

  Route::get('/logout', [

    'uses' => 'UserController@getLogout',

    'as' => 'logout',

  ]);

  Route::get('/account', [

    'uses' => 'UserController@getAccount',

    'as' => 'account',

  ]);

  Route::get('/userimage/{filename}', [

    'uses' => 'UserController@getUserImage',

    'as' => 'account.image',

  ]);

  Route::post('/updateaccount', [

    'uses' => 'UserController@postSaveAccount',

    'as' => 'account.save',

  ]);

  Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' => 'edit'
  ]);

  Route::post('/like', [
    'uses' => 'PostController@postLikePost',
    'as' => 'like'
  ]);

});
