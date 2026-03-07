<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function OrdersPage()
    {
        // Fetch all orders with user and product details
        $ordersRaw = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->select(
                'orders.id as order_id',
                'orders.order_number',
                'orders.payment_method',
                'orders.payment_proof',
                'orders.payment_status',
                'orders.delivery_method',
                'orders.status',
                'orders.created_at',
                'orders.updated_at',
                'users.fullname as customer_name',
                'users.id as user_id',
                'products.product_name',
                'products.product_price',
                'products.product_image',
                'orders.quantity'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get();

        // Group products by order_number
$orders = [];
foreach ($ordersRaw as $item) {
    if (!isset($orders[$item->order_number])) {
        $orders[$item->order_number] = [
            'order_id' => $item->order_id,
            'order_number' => $item->order_number,
            'payment_method' => $item->payment_method,
            'payment_proof' => $item->payment_proof,
            'payment_status' => $item->payment_status,
            'delivery_method' => $item->delivery_method,
            'status' => $item->status,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            'customer_name' => $item->customer_name,
            'user_id' => $item->user_id,
            'products' => []
        ];
    }

    $orders[$item->order_number]['products'][] = [
        'product_name' => $item->product_name,
        'unit_price' => $item->product_price,
        'quantity' => $item->quantity,
        'product_image' => $item->product_image
    ];
}

// Convert grouped array to collection of objects
$orders = collect($orders)->map(function($order) {
    $order['products'] = collect($order['products']); // optional: products as collection
    return (object) $order;
});

        return view('admin.orders', compact('orders'));
    }

public function togglePayment($orderId)
{
    $order = DB::table('orders')->where('id', $orderId)->first();

    if (!$order) {
        return back()->with('error', 'Order not found.');
    }

    $newStatus = ($order->payment_status === 'paid') ? 'not paid' : 'paid';

    DB::table('orders')
        ->where('order_number', $order->order_number)
        ->update(['payment_status' => $newStatus]);

    return back()->with('success', 'Payment status updated to ' . strtoupper($newStatus) . '.');
}

    // Update order status
public function updateStatus(Request $request, $orderId)
{
    $request->validate([
        'status' => 'required'
    ]);

    $order = DB::table('orders')->where('id', $orderId)->first();

    if (!$order) {
        return back()->with('error', 'Order not found.');
    }

    DB::table('orders')
        ->where('order_number', $order->order_number)
        ->update(['status' => $request->status]);

    return back()->with('success', 'Order status updated.');
}
}