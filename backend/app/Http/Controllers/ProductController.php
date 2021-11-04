<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return Product::with(['bids', 'autoBids'])
                            ->where('start', '<', Carbon::now())
                            ->where('end', '>', Carbon::now())
                            ->get();
    }

    public function getProduct($id)
    {
        return Product::with(['bids', 'autoBids'])->find($id);
    }
}
