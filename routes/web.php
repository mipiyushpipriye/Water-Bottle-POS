<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard'); // already logged in
    }
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Stock
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/add', [StockController::class, 'create'])->name('stock.add');
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store');

    // Sales / Billing
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

    // Print bill for a sale
    Route::get('/sales/{sale}/print', [SaleController::class, 'print'])->name('sales.print');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

    // Reports
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');

    // Users (optional if you plan multi-user)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

require __DIR__.'/auth.php';


Route::get('/clear-all', function() {
    $exitCode = Artisan::call('cache:clear');
    echo '<h1>Cache facade value cleared</h1>';

    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';

    $exitCode = Artisan::call('route:cache');
    echo  '<h1>Routes cached</h1>';

    $exitCode = Artisan::call('route:clear');
    echo '<h1>Route cache cleared</h1>';

    $exitCode = Artisan::call('view:clear');
    echo '<h1>View cache cleared</h1>';

    $exitCode = Artisan::call('config:cache');
    echo '<h1>Clear Config cleared</h1>';
});
