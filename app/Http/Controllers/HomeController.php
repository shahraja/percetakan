<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('client.index', compact('products'));
    }

    public function about()
    {
        $products = Product::all();
        return view('client.about', compact('products'));
    }

    public function contact()
    {
        $products = Product::all();
        return view('client.contact', compact('products'));
    }
    
    public function detail_product(Request $request, $id)
    {
        $products = Product::all();
        $product = Product::findOrFail($id);
        return view('client.detail_product', compact('product', 'products'));
    }

    public function cart() 
    {
        $products = Product::all();
        return view('client.cart', compact('products'));
    }

    public function profile()
    {
        $products = Product::all();
        return view('client.profile', compact('products'));
    }
}
