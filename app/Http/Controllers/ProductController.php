<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('price')->get();
        $categories = Category::all();
        return view ('index', compact('products', 'categories'));
    }
}
