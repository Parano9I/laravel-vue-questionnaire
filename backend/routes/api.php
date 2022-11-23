<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    dd(1);
})->middleware(['auth:sanctum', 'role:ROLE_USER']);

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::post('/', 'store')->middleware('guest')->name('users.store');
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('guest')->name('auth.login');
    Route::get('/logout', 'logout')->middleware('auth:sanctum')->name('auth.logout');
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
