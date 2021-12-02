<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function() {
    Route::prefix('/admins')->name('admins.')->group(function() {
        Route::get('', [AdminsController::class, 'index'])->name('index');
        Route::get('/create', [AdminsController::class, 'create'])->name('create');
        Route::post('/', [AdminsController::class, 'store'])->name('store');
    });

    Route::prefix('/students')->name('students.')->group(function() {
        Route::get('/', [StudentsController::class, 'index'])->name('index');
        Route::get('/create', [StudentsController::class, 'create'])->name('create');
        Route::post('/', [StudentsController::class, 'store'])->name('store');
    });
});
