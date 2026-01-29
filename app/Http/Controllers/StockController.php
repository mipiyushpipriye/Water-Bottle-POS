<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')->get();
        return view('stock.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'boxes' => 'required|integer|min:1',
            'type' => 'required|in:IN,OUT',
            'reason' => 'nullable|string'
        ]);

        $product = Product::find($request->product_id);

        if ($request->type === 'IN') {
            $product->stock_boxes += $request->boxes;
        } else {
            $product->stock_boxes -= $request->boxes;
        }
        $product->save();

        StockMovement::create($request->all());

        return redirect()->route('stock.index')->with('success', 'Stock updated successfully!');
    }
}
