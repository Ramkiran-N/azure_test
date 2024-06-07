<?php

use App\Http\UserController;
use Illuminate\Support\Facades\Route;

Route::any('/store-data',[UserController::class,'addUserData']);
Route::any('/store-image',[UserController::class,'storeImage']);
Route::any('/api-key',[UserController::class,'getUser']);
