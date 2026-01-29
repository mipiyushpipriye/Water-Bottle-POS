<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Sale;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('sale')->orderBy('id','desc')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        // Get all sales that have remaining balance
        $sales = Sale::withSum('payments', 'amount') // sum of payments per sale
            ->get()
            ->filter(function ($sale) {
                // remaining amount = grand_total - payments_sum
                $paid = $sale->payments_sum_amount ?? 0;
                return $sale->grand_total > $paid;
            });
        return view('payments.create', compact('sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:Cash,UPI,Card',
        ]);

        $sale = Sale::withSum('payments', 'amount')->find($request->sale_id);
        $paid = $sale->payments_sum_amount ?? 0;
        $remaining = $sale->grand_total - $paid;

        if ($request->amount > $remaining) {
            return back()->withErrors(['amount' => 'Amount cannot exceed remaining balance (₹'.$remaining.')']);
        }

        Payment::create([
            'sale_id' => $sale->id,
            'amount' => $request->amount,
            'method' => $request->method,
        ]);

        return redirect()->route('payments.index')->with('success','Payment recorded successfully!');
    }
}
