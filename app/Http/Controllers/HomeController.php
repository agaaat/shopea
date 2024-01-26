<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('home', compact('products'));
    }

    public function show($id)
    {
        $products = config('products');

        $product = collect($products)->firstWhere('id', $id);
        

        return view('product', compact('product'));
    }
}
