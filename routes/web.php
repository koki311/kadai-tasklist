<?php


//Route::get('/', 'TasksController@index');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', 'TasksController');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

