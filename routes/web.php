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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

 Route::get(
    'posts',
    'PostsController@index'
)->middleware('auth');

// Route::get('posts',function(){
//     return 'hello posts';
// });


Route::get('posts/create','PostsController@create')->name('posts.create')->middleware('auth');;

Route::post('posts','PostsController@store')->name('posts.index');

Route::get('showposts/{id}','PostsController@show')->name('posts.show')->middleware('auth');
// Route::get('{id}/editeposts','PostsController@edite')->name('posts.edite');
// Route::post('{id}/update','PostsController@update')->name('posts.update');

Route::get('posts/{id}/editeposts','PostsController@edite')->name('posts.edite')->middleware('auth');
Route::post('update/{post}','PostsController@update')->name('posts.update')->middleware('auth');

Route::delete('posts/{post}','PostsController@destroy')->middleware('auth');

// Route::get('deleteposts','PostsController@destroy')->name('posts.delete');
//Route::get('deleteposts/{id}','PostsController@destroy')->name('posts.delete');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

