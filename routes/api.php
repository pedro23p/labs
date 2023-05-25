<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

//------------->

Route::group(['prefix' => 'posts','middleware' => 'auth:sanctum'], function() {
    Route::get('/', [PostsController::class,'index']);
    Route::post('add', [PostsController::class,'add']);
    Route::post('update/{id}', [PostsController::class,'update']);
    Route::get('edit/{id}', [PostsController::class,'edit']);
    Route::delete('delete/{id}', [PostsController::class,'delete']);
});