<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::with('brand')->get();
        return view('products.index', compact('products'));
    }

    // Show create product form
    public function create()
    {
        $brands = Brand::all();
        return view('products.create', compact('brands'));
    }

    // Save product
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'size' => 'required|string',
            'qty_per_box' => 'required|integer|min:1',
            'stock_boxes' => 'required|integer|min:0',
            'default_price' => 'nullable|numeric|min:0'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }
}
