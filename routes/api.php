<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
Route::middleware(['auth:sanctum'])->post('logout', 'App\Http\Controllers\Api\AuthController@logout');


Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', '\App\Http\Controllers\Api\V1\UsersApiController');
    Route::apiResource('tasks', '\App\Http\Controllers\Api\V1\TasksApiController');

    Route::get('tasks/search/{name}', function ($name){
        return \App\Models\Task::where('name', 'like', "%".$name."%")->get();
    });
});
