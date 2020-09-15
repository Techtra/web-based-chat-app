<?php

use Illuminate\Support\Facades\Route;

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

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::patch('user/{user}/update', 'Admin\UsersController@updateStatus')->name('patch.user.update');

Route::resource('task', 'TaskController');

Route::middleware('can:manage-users')->group(function(){
    Route::resource('/admin/users', 'Admin\UsersController');
});


//Sending and Receiving Messages
Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');

Route::post('/send', 'MessagesController@postSendMessage');

Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');




