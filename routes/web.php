<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingServiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SuitesController;
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

// Route::get('/suites',function(){
//     return view('suites');
// });

Route::get('suites', [SuitesController::class, 'index']);

// Route::get('suites/{slug}', [SuitesController::class, 'show']);

// Route::resource('suites', SuitesController::class)
//     ->middleware('auth');

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('register', [RegisterController::class, 'index'])->name('register')->middleware('guest');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->middleware('auth');


Route::resource('users', UserController::class)
    ->middleware('auth')
    ->parameters(['users' => 'user:slug']);


Route::resource('services', ServiceController::class)
    ->middleware('auth')
    ->parameters(['services' => 'service:slug']);

Route::resource('rooms', RoomController::class)
    ->middleware('auth')
    ->parameters(['rooms' => 'room:slug']);


Route::middleware(['auth', 'checkMember'])->group(function () {
    Route::get('/suites/{room:slug}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/suites/{room:slug}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking:slug}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking:slug}/payment', [BookingController::class, 'calculateTotal'])->name('bookings.payment');
});

Route::post('/booking/{booking:slug}/services', [BookingServiceController::class, 'store'])->name('booking_services.store');
