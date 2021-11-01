<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    // login routes
    Route::post('/logout',[LoginController::class, 'logout']);

});
Route::post('/login',[LoginController::class, 'authenticate']);
Route::get('/isLogged',[LoginController::class, 'isLogged']);