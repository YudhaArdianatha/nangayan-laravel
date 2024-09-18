<?php

use App\Admin\Controllers\BookingController;
use App\Admin\Controllers\IncomeChartController;
use App\Admin\Controllers\RoomController;
use App\Admin\Controllers\ServiceController;
use App\Admin\Controllers\UserController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('users', UserController::class);
    $router->resource('services', ServiceController::class);
    $router->resource('rooms', RoomController::class);
    $router->resource('bookings', BookingController::class);
    $router->resource('charts', IncomeChartController::class);

    // $router->group(['middleware' => ['can:service.list']], function (Router $router) {
    //     $router->resource('services', ServiceController::class);
    // });
});
