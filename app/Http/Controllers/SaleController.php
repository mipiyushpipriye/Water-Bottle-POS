<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Payment;
use App\Models\Customer;

class SaleController extends Controller
{
    // List all sales
    public function index()
    {
        $sales = Sale::with('items.product', 'payments', 'customer')->orderBy('id', 'desc')->get();
        return view('sales.index', compact('sales'));
    }

    // Show add sale page
    public function create()
    {
        $products = Product::all();
        $customers = Customer::orderBy('name')->get();

        return view('sales.create', compact('products', 'customers'));
    }

    // Save sale
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.boxes' => 'required|integer|min:1',
            'products.*.rate' => 'required|numeric|min:0',
            'payment_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|in:Cash,UPI,Card',
        ]);

        // Calculate totals
        $sub_total = 0;
        foreach ($request->products as $p) {
            $sub_total += $p['boxes'] * $p['rate'];
        }

        $discount = $request->discount ?? 0;
        $grand_total = $sub_total - $discount;

        // Create sale
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'bill_no' => 'BILL-' . time(),
            'sale_date' => now(),
            'sub_total' => $sub_total,
            'discount' => $discount,
            'grand_total' => $grand_total,
        ]);

        // Save sale items and reduce stock
        foreach ($request->products as $p) {
            $product = Product::find($p['product_id']);
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $p['product_id'],
                'boxes' => $p['boxes'],
                'rate' => $p['rate'],
                'total' => $p['boxes'] * $p['rate'],
            ]);

            // Deduct stock
            $product->stock_boxes -= $p['boxes'];
            $product->save();
        }

        // Save payment if entered
        if ($request->payment_amount && $request->payment_method) {
            Payment::create([
                'sale_id' => $sale->id,
                'amount' => $request->payment_amount,
                'method' => $request->payment_method,
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Sale created successfully!');
    }

    public function print(Sale $sale)
    {
        $sale->load('items.product.brand', 'payments', 'customer');

        // Calculate remaining amount
        $paid = $sale->payments->sum('amount');
        $remaining = $sale->grand_total - $paid;

        return view('sales.print', compact('sale', 'paid', 'remaining'));
    }
}