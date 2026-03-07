<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function MyTransactionPage()
    {
        $userId = Auth::id();

        // Fetch all orders with product details
        $ordersRaw = DB::table('orders')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->select(
                'orders.order_number',
                'orders.payment_method',
                'orders.payment_proof',
                'orders.payment_status',
                'orders.delivery_method',
                'orders.status',
                'orders.created_at',
                'orders.updated_at',
                'orders.id as order_id',
                'products.product_name',
                'products.product_image',
                'products.product_price', // <-- directly take product_price
                'orders.quantity'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get();

        // Group products by order_number
        $orders = [];
        foreach ($ordersRaw as $item) {
            if (!isset($orders[$item->order_number])) {
                $orders[$item->order_number] = [
                    'order_number' => $item->order_number,
                    'payment_method' => $item->payment_method,
                    'payment_proof' => $item->payment_proof,
                    'payment_status' => $item->payment_status,
                    'delivery_method' => $item->delivery_method,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'products' => []
                ];
            }

            $orders[$item->order_number]['products'][] = [
                'product_name' => $item->product_name,
                'unit_price' => $item->product_price, // <-- use product_price
                'quantity' => $item->quantity,
                'product_image' => $item->product_image
            ];
        }

        $orders = collect($orders);

        return view('transaction', compact('orders'));
    }
}