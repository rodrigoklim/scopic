<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'bid'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
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
        return Product::with(['bids'])->find($newBid->product_id);
    }

}
