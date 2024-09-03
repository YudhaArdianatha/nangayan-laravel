<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\Service;
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

Route::post('/register', [RegisterController::class, 'store']);

Route::resource('users', UserController::class)
    ->parameters(['users' => 'user:slug']);

// Route::put('users/{user}', [UserController::class, 'update']);

// Route::resource('services', ServiceController::class);
Route::get('services', [ServiceController::class, 'index']);
Route::get('services/{slug}', [ServiceController::class, 'show']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('services', [ServiceController::class, 'store']);
    Route::put('services/{slug}', [ServiceController::class, 'update']);
    Route::delete('services/{slug}', [ServiceController::class, 'destroy']);
});

// Route::resource('rooms', RoomController::class);

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::get('rooms', [RoomController::class, 'index']);
// });