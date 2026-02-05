<?php

use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});


Route::middleware('auth')->group(function () {

    Route::middleware(['role:ADMIN'])->prefix('admin')->name('admin.')->group(function(){

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::get('/users/create',[UserController::class,'create'])->name('users.create');
        Route::resource('users', UserController::class);
        Route::resource('classes', ClasseController::class);


    });

    Route::middleware(['role:TRAINER'])->prefix('trainer')->name('trainer.')->group(function(){
        Route::get('/dashboard', [TrainerController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['role:LEARNER'])->prefix('learner')->name('learner.')->group(function(){
        Route::get('/dashboard', [LearnerController::class, 'index'])->name('dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
