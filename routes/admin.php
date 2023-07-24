<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SupplyController;
use App\Http\Controllers\Admin\MotionController;
use App\Http\Controllers\Admin\HistoryController;

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

Route::get('/', [HomeController::class,'index']);
Route::resource('users', UserController::class)->names('admin.users');
Route::resource('cars', CarController::class)->names('admin.cars');
Route::resource('supplies', SupplyController::class)->names('admin.supplies');
Route::resource('motions', MotionController::class)->names('admin.motions');
Route::resource('histories', HistoryController::class)->names('admin.histories');

