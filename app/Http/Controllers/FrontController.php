<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $product1 = Product::with('category')
            ->latest()
            ->first();

        $product2 = Product::with('category')
            ->latest()
            ->skip(1)
            ->take(6)
            ->get();

        $products = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        return view('partials.main', compact('product1', 'product2', 'products'));
    }
}
