<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function ShopPage(Request $request)
{
    $categoryId = $request->category;

    $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.category_name')
        ->where('products.product_stocks', '>', 0) // Only available products
        ->when($categoryId, function ($query, $categoryId) {
            return $query->where('products.category_id', $categoryId);
        })
        ->get();

    $categories = DB::table('categories')->get();

    return view('shop', compact('products', 'categories', 'categoryId'));
}

    public function ProductSearch(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name');

        if ($category) {
            $query->where('products.category_id', $category);
        }

        if ($search) {
            $query->where('products.product_name', 'like', "%$search%");
        }

        $products = $query->get();

        return response()->json($products);
    }
}
