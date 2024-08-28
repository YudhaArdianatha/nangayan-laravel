<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('guest');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->middleware('auth');

// Route::get('/users', [UserController::class, 'index'])->middleware('auth');

// Route::get('/users/{user:slug}', [UserController::class, 'show']);

// Route::get('/users/{user:slug}/edit', [UserController::class, 'edit']);

// Route::put('/users/{user:slug}', [UserController::class, 'update']);

// Route::delete('/users/{user:slug}', [UserController::class, 'destroy']);

Route::resource('users', UserController::class)
    ->middleware('auth')
    ->parameters(['users' => 'user:slug']);

// Route::post('/services', [ServiceController::class, 'store']);

// Route::get('/services', [ServiceController::class, 'index'])->middleware('auth');

// Route::get('/services/{service:slug}', [ServiceController::class, 'show']);

// Route::get('/services', [ServiceController::class, 'create'])->middleware('auth');

Route::resource('services', ServiceController::class)
    ->middleware('auth')
    ->parameters(['services' => 'service:slug']);