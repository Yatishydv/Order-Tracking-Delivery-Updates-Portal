<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'product_name' => 'required|string',
            'address' => 'required|string',
            'estimated_delivery' => 'required|date'
        ]);

        $order = Order::create([
            'user_id' => $request->customer_id,
            'product_name' => $request->product_name,
            'address' => $request->address,
            'estimated_delivery' => $request->estimated_delivery,
            'status' => 'Order Placed'
        ]);

        $order->updates()->create([
            'status' => 'Order Placed',
            'message' => 'Your order has been placed successfully.'
        ]);

        return back()->with('success', 'Order created successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }
}
