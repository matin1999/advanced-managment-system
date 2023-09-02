<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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
    return view('welcome');
})->name('home');
Route::prefix('/auth')->namespace('Api')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('registerUser');
    Route::post('/login', [AuthController::class, 'login'])->name('loginUser');
    Route::get('/view-register', [AuthController::class, 'registerView'])->name('register');
    Route::get('/view-login', [AuthController::class, 'loginView'])->name('login');
});
Route::prefix('/dashboard')->middleware('auth')->group( function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

});
