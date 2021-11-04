<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AutoBid extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'product_id'
    ];

    protected $appends = ['thumb', 'product', 'price'];
 
    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
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

    public function getPriceAttribute()
    {
        $product = Product::with(['bids'])->find($this->product_id);
        return isset($product->bids[0]->bid) ? $product->bids[0]->bid : $product->auction_price;
    }

    public function handleDestroy($id)
    {
        
        $user_id = AutoBid::find($id);
        $delete = Autobid::destroy($id);

        if($delete){
            return AutoBid::where('user_id', $user_id->user_id)->get();
        }
    }

    public function handleNewAutoBid($data)
    {
        if(AutoBid::where('user_id', $data['user'])->where('product_id', $data['product']['id'])->count() > 0){
            return json_encode(['error' => 'AutoBid already set for item']);
        }
        
        $create = AutoBid::create([
            'user_id' => $data['user'],
            'product_id' => $data['product']['id']
        ]);

        return AutoBid::where('user_id', $create->user_id)->get();
    }

    public function handleAutoBidBot($data)
    {
        $autobids = AutoBid::where('product_id', $data->product_id)->get();
        $bid = $data->bid;
        
        foreach($autobids as $autobid){
            if($autobid->user_id !== $data->user_id){
                if($this->checkWallet($autobid->user_id)){
                    Bid::create([
                        'user_id' => $autobid->user_id,
                        'product_id' => $data->product_id,
                        'bid' => floatval($bid) +1,
                    ]);
                }
            }
        }
    }

    private function checkWallet($user_id)
    {
        $user = User::find($user_id);
        
        if($user->wallet['amount'] > 0){
            $autobid = file_get_contents(public_path('autobid-'.$user_id.'.env'));
            if(isset($autobid)){
            $config = explode(';',$autobid);
            $maxAmount = explode('=', $config[2]);
            $maxAmount[1] = floatval($user->wallet['amount']) - 1;
            $config[2] = implode('=', $maxAmount);
            $autobid = implode(';', $config);
        
            $autobid = file_put_contents(public_path('autobid-'.$user_id.'.env'),$autobid);
            }
            return true;            
        } else {
            return false;
        }

    }

}
