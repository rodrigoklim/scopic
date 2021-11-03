<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $product = Product::find(rand(1,50))->with(['bids']);
        $product = Product::find(9);
        
        if($product->bids->max('bid') !== null){
            $bid = floatval($product->bids->max('bid'));
        } else {
            $bid = $product->auction_price;
        }

        return [
            'user_id' => rand(1,3),
            'product_id' => $product->id,
            'bid' => $bid++
        ];
    }
}
