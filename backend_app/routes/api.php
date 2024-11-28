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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/user-profile', [\App\Http\Controllers\AuthController::class, 'userProfile']);
    Route::post('/change-pass', [\App\Http\Controllers\AuthController::class, 'changePassWord']);

    Route::get('google', [\App\Http\Controllers\AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('google/callback', [\App\Http\Controllers\AuthController::class, 'handleGoogleCallback']);

     Route::post('upload-file', [\App\Http\Controllers\FileController::class, 'upload'])->name('file.upload');
});

Route::group([
    'middleware' => 'api',
], function ($router) {
     Route::post('upload-file', [\App\Http\Controllers\FileController::class, 'upload'])->name('file.upload');
});

