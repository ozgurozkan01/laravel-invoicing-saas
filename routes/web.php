<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('features', function () { return view('features'); })->name('features.index');
Route::get('pricing', function () { return view('pricing'); })->name('pricing.index');
Route::get('faq', function () { return view('faq'); })->name('faq.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('clients', ClientController::class)->except(['show']);

    // Route::post('/invoices', [InvoiceController::class, 'store'])->middleware(['invoice.limit']);
});

require __DIR__.'/auth.php';
