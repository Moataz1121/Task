<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register' , [RegisterController::class , 'store'])->name('register');
Route::post('login' , [LoginController::class , 'store'])->name('login');
Route::post('logout' , [LoginController::class , 'destroy'])->name('logout');

Route::apiResource('tasks' , TaskController::class)->middleware('auth:sanctum');