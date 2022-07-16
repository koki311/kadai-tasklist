<?php


Route::get('/', 'TasksController@index');

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('tasks', 'TasksController');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//認証付きルーティング(https://laraweb.net/practice/1854/)
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users','Controller',['only'=>['index','show']]);
    Route::resource('tasks', 'TasksController', ['only' => ['store', 'destroy']]);
});
