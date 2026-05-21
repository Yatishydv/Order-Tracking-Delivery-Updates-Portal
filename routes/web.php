<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/privacy', function () { return view('privacy'); })->name('privacy');

Route::post('/contact-submit', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);
    \App\Models\ContactMessage::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
        'is_read' => false
    ]);
    return back()->with('success', 'Message sent successfully! Our team will get back to you within 24 hours.');
})->name('contact.submit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    Route::post('orders/{order}/assign', [App\Http\Controllers\AdminController::class, 'assignAgent'])->name('orders.assign');
    Route::get('/shipments', [App\Http\Controllers\AdminController::class, 'shipments'])->name('shipments');
    Route::post('approve-agent/{user}', [App\Http\Controllers\AdminController::class, 'approveAgent'])->name('approve_agent');
    Route::post('revoke-agent/{user}', [App\Http\Controllers\AdminController::class, 'revokeAgent'])->name('revoke_agent');
    Route::delete('messages/{message}', [App\Http\Controllers\AdminController::class, 'resolveMessage'])->name('messages.resolve');
});

// Agent Routes
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AgentController::class, 'index'])->name('dashboard');
    Route::post('/orders/{order}/status', [App\Http\Controllers\AgentController::class, 'updateStatus'])->name('orders.update');
});

// Customer Routes (Orders & Request Agent) - Accessible by Agents too for their personal orders
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/orders', [App\Http\Controllers\TrackingController::class, 'index'])->name('orders');
    Route::post('/request-agent', [App\Http\Controllers\TrackingController::class, 'requestAgent'])->name('request_agent');
});

// Shared Tracking Route (Customer, Agent, Admin)
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/tracking/{order}', [App\Http\Controllers\TrackingController::class, 'show'])->name('tracking');
});

// Real-time API (Internal)
Route::get('/api/tracking/{order}', [App\Http\Controllers\TrackingController::class, 'getStatus'])->name('api.tracking');
