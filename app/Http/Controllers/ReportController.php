<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class ReportController extends Controller
{
    public function daily(Request $request)
    {
        $date = $request->date ?? date('Y-m-d');
        $sales = Sale::whereDate('sale_date', $date)->get();
        return view('reports.daily', compact('sales', 'date'));
    }

    public function monthly(Request $request)
    {
        $month = $request->month ?? date('Y-m');
        $sales = Sale::where('sale_date', 'like', $month.'%')->get();
        return view('reports.monthly', compact('sales', 'month'));
    }
}
