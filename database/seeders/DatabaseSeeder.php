<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@track.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Delivery Agents
        $agent1 = User::factory()->create([
            'name' => 'Agent Alex',
            'email' => 'alex@track.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'agent',
        ]);

        User::factory()->create([
            'name' => 'Agent Sarah',
            'email' => 'sarah@track.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'agent',
        ]);

        // Customers
        $customer = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'customer',
        ]);

        // Sample Order for John
        $order = \App\Models\Order::create([
            'user_id' => $customer->id,
            'product_name' => 'MacBook Pro M3',
            'address' => '123 Tech Lane, Silicon Valley, CA 94025',
            'status' => 'Shipped',
            'assigned_agent_id' => $agent1->id,
            'estimated_delivery' => now()->addDays(3),
        ]);

        // History for the sample order
        $order->updates()->create(['status' => 'Order Placed', 'message' => 'Your order has been placed successfully.', 'created_at' => now()->subDays(2)]);
        $order->updates()->create(['status' => 'Packed', 'message' => 'Order has been packed and assigned to delivery agent.', 'created_at' => now()->subDays(1)]);
        $order->updates()->create(['status' => 'Shipped', 'message' => 'Package is on its way to the destination.', 'created_at' => now()]);
    }
}
