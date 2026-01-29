<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
