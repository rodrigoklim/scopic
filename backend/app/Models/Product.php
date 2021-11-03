<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product', 'description', 'style', 'auction_price', 'start', 'end', 'image_path1', 'image_path2', 'image_path3'
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class, 'product_id', 'id')->orderBy('bid', 'desc');
    }

    public function autoBids()
    {
        return $this->hasMany(AutoBid::class, 'product_id', 'id');
    }
}
