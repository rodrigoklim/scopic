<?php

namespace App\Jobs;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BidBot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function handle()
    {
        $product_id = rand(1, 5);

        $lastBid = Bid::where('product_id', $product_id)->orderBy('bid', 'desc')->first();

        if(!isset($lastBid)){
            $product = Product::find($product_id);
            $price = $product->auction_price;
        } else {
            $price = $lastBid->bid;
        }

        $newBid = [
            'user' => rand(11, 20),
            'product' =>[
                'id' => $product_id
            ],
            'bid' => $price
        ]; 
        $bid = new Bid();
        $bid->handleNewBid($newBid);
    }

}
