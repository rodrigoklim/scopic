<?php

namespace App\Models;

use App\Events\BidNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'bid'
    ];

    protected $appends = ['thumb', 'product'];
 

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function getThumbAttribute()
    {
        $product = Product::find($this->product_id);
        return $product->image_path1;
    }

    public function getProductAttribute()
    {
        $product = Product::find($this->product_id);
        return $product->product;
    }

    public function handleNewBid($data)
    {
        $newBid = Bid::create([
            'user_id' => $data['user'],
            'product_id' => $data['product']['id'],
            'bid' => floatval($data['bid']) + 1,
        ]);

        if(isset($newBid)){
            $autoBid = new AutoBid();
            $autoBid->handleAutoBidBot($newBid);
        }
        
        $products = Product::with(['bids','autoBids'])->get();

        BidNotification::dispatch([
            'product' => $newBid->product_id,
        ]);

        return $products;
    }

}
