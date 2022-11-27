<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::post('/', 'store')->middleware('guest')->name('users.store');
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('guest')->name('auth.login');
    Route::get('/logout', 'logout')->middleware('auth:sanctum')->name('auth.logout');
});

Route::prefix('questionnaires')->middleware(['auth:sanctum', 'role:ROLE_USER'])
    ->controller(QuestionnaireController::class)->group(function () {
        Route::get('/', 'index')->name('questionnaires.index');

        Route::controller(QuestionController::class)->group(function () {
            Route::get('{questionnaireId}/questions', 'index')->name('questionnaires.questions.index');
        });

        Route::controller(AnswerController::class)->group(function () {
            Route::post('{questionnaireId}/answer', 'storeAll')->name('questionnaires.answer.store.all');
        });
    });
