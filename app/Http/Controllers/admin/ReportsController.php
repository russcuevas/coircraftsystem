<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function ReportsPage()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Today's Sales
        $todaySales = DB::table('orders')
            ->whereDate('created_at', $today)
            ->where('payment_status', 'paid')
            ->where('status', 'Completed')
            ->sum(DB::raw('price * quantity'));

        // Monthly Sales
        $monthlySales = DB::table('orders')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->where('payment_status', 'paid')
            ->where('status', 'Completed')
            ->sum(DB::raw('price * quantity'));

        // Weekly sales (for chart)
        $weeklySales = DB::table('orders')
            ->select(
                DB::raw('WEEK(created_at) as week'),
                DB::raw('SUM(price * quantity) as total')
            )
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('payment_status', 'paid')
            ->where('status', 'Completed')
            ->groupBy('week')
            ->pluck('total');

        // Inventory counts
        $availableStock = DB::table('products')->where('product_stocks', '>', 10)->count();
        $lowStock = DB::table('products')
            ->whereBetween('product_stocks', [1, 10])
            ->count();

        $outStock = DB::table('products')
            ->where('product_stocks', 0)
            ->count();

        // Inventory Breakdown
        $inventory = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'categories.category_name',
                DB::raw('COUNT(products.id) as total_products'),
                DB::raw('SUM(products.product_stocks) as total_stock'),
                DB::raw('SUM(products.product_sales) as sold_count'),
                DB::raw('SUM(products.product_price * products.product_stocks) as estimated_value')
            )
            ->groupBy('categories.category_name')
            ->get();

        return view('admin.reports', compact(
            'todaySales',
            'monthlySales',
            'weeklySales',
            'availableStock',
            'lowStock',
            'outStock',
            'inventory'
        ));
    }
}