<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request) {
        $page = $request->query("page");
        $size = $request->query("size");
        if (!$page)
            $page = 1;
        if (!$size)
            $size = 12;
        $products = Product::orderBy('created_at', 'DESC')->paginate($size);
        return view('shop', ['products'=>$products,'page'=>$page,'size'=>$size]);
    }

    public function productDetails($slug) {
        $product = Product::where('slug', $slug)->first();
        $rproducts = Product::where('slug', '!=', $slug)->inRandomOrder('id')->get()->take(8);
        return view('details', ['product'=>$product, 'rproducts'=>$rproducts]);
    }
}