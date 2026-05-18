<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/services', function () { return view('services'); })->name('services');
Route::get('/enterprise', function () { return view('solutions.enterprise'); })->name('enterprise');
Route::get('/api-solutions', function () { return view('solutions.api'); })->name('api');
Route::get('/sme', function () { return view('solutions.sme'); })->name('sme');
Route::get('/secure-cargo', function () { return view('solutions.secure'); })->name('secure');
Route::get('/air-freight', function () { return view('solutions.freight'); })->name('freight');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/fleet', function () { return view('fleet'); })->name('fleet');
Route::get('/legal', function () { return view('legal'); })->name('legal');
Route::get('/privacy', function () { return view('privacy'); })->name('privacy');
Route::get('/terms', function () { return view('terms'); })->name('terms');
Route::get('/cookies', function () { return view('cookies'); })->name('cookies');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    Route::post('orders/{order}/assign', [App\Http\Controllers\AdminController::class, 'assignAgent'])->name('orders.assign');
    Route::post('approve-agent/{user}', [App\Http\Controllers\AdminController::class, 'approveAgent'])->name('approve_agent');
});

// Agent Routes
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AgentController::class, 'index'])->name('dashboard');
    Route::post('/orders/{order}/status', [App\Http\Controllers\AgentController::class, 'updateStatus'])->name('orders.update');
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/orders', [App\Http\Controllers\TrackingController::class, 'index'])->name('orders');
    Route::get('/tracking/{order}', [App\Http\Controllers\TrackingController::class, 'show'])->name('tracking');
    Route::post('/request-agent', [App\Http\Controllers\TrackingController::class, 'requestAgent'])->name('request_agent');
});

// Real-time API (Internal)
Route::get('/api/tracking/{order}', [App\Http\Controllers\TrackingController::class, 'getStatus'])->name('api.tracking');
