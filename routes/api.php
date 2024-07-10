<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/password/reset/request', [PasswordResetController::class, 'requestPasswordReset']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset');

Route::middleware('auth:api')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index']);
    Route::post('logout', [ProfileController::class, 'logout']);
});


