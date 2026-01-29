<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSales = Sale::sum('grand_total');
        $totalStock = Product::sum('stock_boxes');

        return view('dashboard.index', compact('totalProducts', 'totalSales', 'totalStock'));
    }
}
