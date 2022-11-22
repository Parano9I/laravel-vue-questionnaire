<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->controller(UserController::class)->group(function (){
    Route::post('/', 'store')->middleware('guest')->name('users.store');
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
