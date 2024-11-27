<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;


use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'get_all_user']);



Route::post('/addUsers', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
