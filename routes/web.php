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

Route::get('/', function () {
    return view('welcome');
});
Route::any('/index',"IndexController@index");
Route::any('/addDo',"IndexController@addDo");

Route::get('/test/add', function () {
    return view('api/test/add');
});
Route::any('/test/show', function () {
    return view('api/test/show');
});
Route::any('/test/find', function () {
    return view('api/test/find');
});

Route::any('/user',"Api\\test\\TestController1@user");
