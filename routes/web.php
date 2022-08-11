<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\YtdlController;
use App\Http\Controllers\InviteController;

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

Route::get('/', [App\Http\Controllers\YtdlController::class, 'index'])->name('home');

/* RESTRICTED AREA */
Route::middleware('auth')->group(function() {

  Route::prefix('ytdl')->group(function() {

    Route::post('infoRequest', [YtdlController::class, 'infoRequest']);
    Route::post('infoGet', [YtdlController::class, 'infoGet']);
    Route::post('downloadRequest', [YtdlController::class, 'downloadRequest']);
    Route::post('downloadInfo', [YtdlController::class, 'downloadInfo']);
    Route::get('download/{id}', [YtdlController::class, 'download'])->where('id','[a-zA-Z0-9]+');

  });

  Route::get('invite', [InviteController::class,'invite'])->name('invite');
  Route::post('invite', [InviteController::class,'process'])->name('process');

});

/* ONLY FOR GUESTS */
Route::middleware('guest')->group(function(){
  Route::get('/register', function(){
    return view('auth.registerWithoutToken');
  });
  // {token} is a required parameter that will be exposed to us in the controller method
  Route::get('/register/{token?}', [App\Http\Controllers\InviteController::class, 'registerForm'])->name('register');
  Route::get('accept/{token}', function($token){
    return Redirect::route('register', ['token'=>$token]);
  })->name('accept');
});
