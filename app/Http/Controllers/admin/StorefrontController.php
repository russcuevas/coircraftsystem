<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorefrontController extends Controller
{
    public function StorefrontPage()
    {
        $newArrivals = DB::table('products')->where('product_feature', 'new')->get();
        $trendingProducts = DB::table('products')->where('product_feature', 'trending')->get();
        $bestSellers = DB::table('products')->where('product_feature', 'best seller')->get();

        $availableProducts = DB::table('products')->where('product_feature', 'none')->get();

        return view('admin.storefront', compact(
            'newArrivals',
            'trendingProducts',
            'bestSellers',
            'availableProducts'
        ));
    }
    public function UpdateProductFeatures(Request $request)
    {
        $productIds = $request->input('product_ids', []);
        $feature = $request->input('feature');

        DB::table('products')
            ->whereIn('id', $productIds)
            ->update(['product_feature' => $feature]);

        return redirect()->back()->with('success', 'Products updated successfully.');
    }

    public function DeleteProductFeature($id)
    {
        DB::table('products')
            ->where('id', $id)
            ->update(['product_feature' => 'none']);

        return redirect()->back()->with('success', 'Product removed from storefront successfully.');
    }
}
