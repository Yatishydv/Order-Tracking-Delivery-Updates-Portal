<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->assignedOrders()->with('customer')->latest()->get();
        return view('agent.dashboard', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Packed,Shipped,Out for Delivery,Delivered',
            'message' => 'nullable|string'
        ]);

        $order->update(['status' => $request->status]);

        $order->updates()->create([
            'status' => $request->status,
            'message' => $request->message ?? "Status updated to {$request->status}"
        ]);

        return back()->with('success', "Order status updated to {$request->status}");
    }
}
