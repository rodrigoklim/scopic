<?php

use App\Http\Controllers\BidController;
use App\Http\Controllers\AutoBidController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    // login routes
    Route::post('/logout',[LoginController::class, 'logout']);

    // product routes
    Route::get('/products',[ProductController::class, 'index']);

    // Bid routes
    Route::post('/bid',[BidController::class, 'bid']);

    // AutoBid routes
    Route::post('/autobid',[AutoBidController::class, 'store']);
    Route::delete('/autobid/{id}',[AutoBidController::class, 'destroy']);


});
Route::post('/login',[LoginController::class, 'authenticate']);
Route::get('/isLogged',[LoginController::class, 'isLogged']);

Route::get('/auth', function(){
    dd(Auth::check());
});