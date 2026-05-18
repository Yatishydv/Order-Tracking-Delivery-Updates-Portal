<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('search')) {
            $query->where('id', 'like', "%{$request->search}%")
                  ->orWhere('product_name', 'like', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stats = [
            'total' => Order::count(),
            'delivered' => Order::where('status', 'Delivered')->count(),
            'pending' => Order::where('status', '!=', 'Delivered')->count(),
            'active' => Order::whereIn('status', ['Shipped', 'Out for Delivery'])->count(),
        ];

        $orders = $query->with(['customer', 'agent'])->latest()->paginate(10)->withQueryString();
        $agents = User::where('role', 'agent')->get();
        $pendingAgents = User::where('requested_role', 'agent')->where('role', '!=', 'agent')->get();

        return view('admin.dashboard', compact('stats', 'orders', 'agents', 'pendingAgents'));
    }

    public function assignAgent(Request $request, Order $order)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
        ]);

        $order->update([
            'assigned_agent_id' => $request->agent_id,
            'status' => 'Packed'
        ]);

        $order->updates()->create([
            'status' => 'Packed',
            'message' => 'Order has been packed and assigned to delivery agent.'
        ]);

        return back()->with('success', 'Agent assigned successfully.');
    }

    public function approveAgent(User $user)
    {
        $user->update([
            'role' => 'agent',
            'requested_role' => null
        ]);

        return back()->with('success', 'Agent approved successfully.');
    }
}
