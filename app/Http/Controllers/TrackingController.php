<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('customer.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user owns the order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('updates');
        return view('customer.tracking', compact('order'));
    }

    public function getStatus(Order $order)
    {
        return response()->json([
            'status' => $order->status,
            'updates' => $order->updates()->latest()->get(),
            'estimated_delivery' => $order->estimated_delivery ? $order->estimated_delivery->format('Y-m-d H:i:s') : null,
        ]);
    }
}
