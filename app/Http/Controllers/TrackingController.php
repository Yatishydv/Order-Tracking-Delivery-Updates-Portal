<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('id', 'like', "%{$request->search}%")
                  ->orWhere('product_name', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();
        return view('customer.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user is the customer, the assigned agent, or an admin
        $user = auth()->user();
        if ($order->user_id !== $user->id && $order->assigned_agent_id !== $user->id && $user->role !== 'admin') {
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

    public function requestAgent(Request $request)
    {
        $user = auth()->user();
        if ($user->role === 'customer' && $user->requested_role !== 'agent') {
            $user->update(['requested_role' => 'agent']);
            return back()->with('success', 'Application to become an Agent has been submitted and is pending admin approval.');
        }
        return back();
    }
}
