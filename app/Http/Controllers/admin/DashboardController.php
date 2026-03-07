<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function DashboardPage()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Today's sales (sum all items)
        $todaysSales = DB::table('orders')
            ->whereDate('created_at', $today)
            ->where('payment_status', 'paid')
            ->where('status', 'Completed')
            ->sum(DB::raw('price * quantity'));

        // Monthly sales
        $monthlySales = DB::table('orders')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->where('payment_status', 'paid')
            ->where('status', 'Completed')
            ->sum(DB::raw('price * quantity'));

        // Total orders (unique order_number)
        $totalOrders = DB::table('orders')
            ->distinct('order_number')
            ->count('order_number');

        // Pending orders (unique order_number)
        $pendingOrders = DB::table('orders')
            ->where('status', 'Pending')
            ->distinct('order_number')
            ->count('order_number');

        $recentOrders = DB::table('orders')
    ->leftJoin('users', 'orders.user_id', '=', 'users.id')
    ->select(
        'orders.order_number',
        'users.fullname as customer_name',
        DB::raw('MAX(orders.created_at) as created_at'),
        DB::raw('SUM(orders.price * orders.quantity) as total_price'),
        DB::raw('MAX(orders.status) as status'),
        DB::raw('MAX(orders.payment_status) as payment_status')
    )
    ->groupBy('orders.order_number', 'users.fullname')
    ->orderByDesc(DB::raw('MAX(orders.created_at)'))
    ->limit(5)
    ->get();

        return view('admin.dashboard', compact(
            'todaysSales',
            'monthlySales',
            'totalOrders',
            'pendingOrders',
            'recentOrders'
        ));
    }
}