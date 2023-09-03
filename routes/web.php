<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Start Auth

Route::get('/', function (){
    if (auth()->user()){
        return redirect()->route('admin.dashboard');
    }else{
        return redirect()->route('login');
    }
})->name('/');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('check_auth');

Route::get('/register', function(){
    return view('auth.register');
})->name('register')->middleware('check_auth');;

Route::post('/register/create', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store')->middleware('check_auth');;
Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::post('user/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('user.login');

//End Auth



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Auth', 'middleware' => ['auth']], function()
{
    Route::get('/', function (){
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', '\App\Http\Controllers\Admin\UserController');
});
