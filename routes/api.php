<?php

use App\Http\Controllers\API\V1\User\Auth\AuthController;
use App\Http\Controllers\API\V1\User\UserController;
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


Route::prefix('v1/')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('api.user.register');
    Route::post('login', [AuthController::class, 'login'])->name('api.user.login');
});
Route::middleware('auth:sanctum')->prefix('v1/')->group(function () {
    Route::get('profile', [UserController::class, 'show'])->name('api.profile.show');

    Route::post('logout', [AuthController::class, 'logout'])->name('api.user.logout');
});


