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

        $thisWeekStart = now()->subDays(7);
        $lastWeekStart = now()->subDays(14);
        $lastWeekEnd = now()->subDays(7);

        $calcGrowth = function ($current, $previous) {
            if ($previous == 0) return $current > 0 ? 100 : 0;
            return round((($current - $previous) / $previous) * 100, 1);
        };

        // Current week metrics
        $totalCurrent = Order::where('created_at', '>=', $thisWeekStart)->count();
        $deliveredCurrent = Order::where('status', 'Delivered')->where('created_at', '>=', $thisWeekStart)->count();
        $pendingCurrent = Order::where('status', '!=', 'Delivered')->where('created_at', '>=', $thisWeekStart)->count();
        $activeCurrent = Order::whereIn('status', ['Shipped', 'Out for Delivery'])->where('created_at', '>=', $thisWeekStart)->count();

        // Last week metrics
        $totalPrevious = Order::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
        $deliveredPrevious = Order::where('status', 'Delivered')->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
        $pendingPrevious = Order::where('status', '!=', 'Delivered')->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
        $activePrevious = Order::whereIn('status', ['Shipped', 'Out for Delivery'])->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();

        $stats = [
            'total' => Order::count(),
            'total_growth' => $calcGrowth($totalCurrent, $totalPrevious),
            
            'delivered' => Order::where('status', 'Delivered')->count(),
            'delivered_growth' => $calcGrowth($deliveredCurrent, $deliveredPrevious),
            
            'pending' => Order::where('status', '!=', 'Delivered')->count(),
            'pending_growth' => $calcGrowth($pendingCurrent, $pendingPrevious),
            
            'active' => Order::whereIn('status', ['Shipped', 'Out for Delivery'])->count(),
            'active_growth' => $calcGrowth($activeCurrent, $activePrevious),
        ];

        $orders = $query->with(['customer', 'agent'])->latest()->paginate(10)->withQueryString();
        $agents = User::where('role', 'agent')->get();
        $pendingAgents = User::where('requested_role', 'agent')->where('role', '!=', 'agent')->get();
        $contactMessages = \App\Models\ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'orders', 'agents', 'pendingAgents', 'contactMessages'));
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

    public function revokeAgent(User $user)
    {
        $user->update([
            'role' => 'customer',
            'requested_role' => null
        ]);

        return back()->with('success', 'Agent revoked successfully.');
    }

    public function shipments(Request $request)
    {
        $query = Order::query();

        if ($request->filled('search')) {
            $query->where('id', 'like', "%{$request->search}%")
                  ->orWhere('product_name', 'like', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->with(['customer', 'agent'])->latest()->paginate(20)->withQueryString();
        $agents = User::where('role', 'agent')->get();

        return view('admin.shipments', compact('orders', 'agents'));
    }

    public function resolveMessage(\App\Models\ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Support message marked as resolved and removed.');
    }
}
