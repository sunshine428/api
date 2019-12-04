<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//添加接口
Route::any('/add_do',"Api\\test\\TestController1@add_do");
//查询接口
Route::any('/test_show',"Api\\test\\TestController1@test_show");
//修改默认查询接口
Route::any('/test_find',"Api\\test\\TestController1@find");
//修改接口
Route::any('/test_update',"Api\\test\\TestController1@update");
//删除
Route::any('/test_del',"Api\\test\\TestController1@del");

Route::resource('test', 'Api\\test\\TestController');

Route::resource('user', 'Api\\test\\UserController');