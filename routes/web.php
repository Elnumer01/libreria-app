<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LoanController;


Route::get('/', function () {
    return view('Pages.Login');
});

Route::post('session',[AuthController::class,'login']);
Route::get('login',[AuthController::class,'loginView'])->name('login');


Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('authors',AuthorController::class);
    Route::resource('loans',LoanController::class);
    Route::get('logout',[AuthController::class,'logout']);
});
