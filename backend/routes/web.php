<?php

use App\Events\BidNotification;
use App\Http\Controllers\AutoBidController;
use App\Http\Controllers\ProductController;
use App\Models\AutoBid;
use App\Models\Bid;
use App\Models\Product;
use App\Models\User;
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

Route::get('/', function () {
    $user1 = User::create([
        'email' => 'user1@scopic',
        'name' => 'User 1',
        'password' => '1234'
    ]);

    $user2 = User::create([
        'email' => 'user2@scopic',
        'name' => 'User 2',
        'password' => '1234'
    ]);

    $auto = Product::factory()->count(20)->create();
});
Route::get('/autobid/{id}',[AutoBidController::class, 'destroy']);
Route::get('/products',[ProductController::class, 'index']);