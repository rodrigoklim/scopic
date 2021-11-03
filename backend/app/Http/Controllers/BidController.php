<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    protected $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    public function bid(Request $request)
    {
        $validate = $request->validate([
            'user' => 'required',
            'product' => 'required',
            'bid' => 'required'
        ]);

        return $this->bid->handleNewBid($request);
    }
}
