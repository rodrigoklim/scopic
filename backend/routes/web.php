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
    event(new BidNotification('hello'));

    BidNotification::dispatch('world');
    // $product_id = 21; //rand(1, 50);

    // $lastBid = Bid::where('product_id', $product_id)->orderBy('bid', 'desc')->first();

    // if(!isset($lastBid)){
    //     $product = Product::find($product_id);
    //     $price = $product->auction_price;
    // } else {
    //     $price = $lastBid->bid;
    // }

    // $newBid = [
    //     'user' => 2,//rand(11, 20),
    //     'product' =>[
    //         'id' => $product_id
    //     ],
    //     'bid' => $price
    // ]; 

    // $bid = new Bid();
    // $bid->handleNewBid($newBid);
    // $auto = Product::factory()->count(20)->create();
});
Route::get('/autobid/{id}',[AutoBidController::class, 'destroy']);
Route::get('/products',[ProductController::class, 'index']);