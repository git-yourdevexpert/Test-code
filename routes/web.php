<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CopartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IaaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [LoginController::class, 'showLoginForm']);

Auth::routes();

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::patch('/settings', [SettingController::class, 'update'])->name('settings.update');
});
