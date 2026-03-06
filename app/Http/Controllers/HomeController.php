<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function HomePage()
    {
        $newArrivals = DB::table('products')->where('product_feature', 'new')->get();
        $trendingProducts = DB::table('products')->where('product_feature', 'trending')->get();
        $bestSellers = DB::table('products')->where('product_feature', 'best seller')->get();
        $categories = Categories::all();

        return view('welcome', compact('newArrivals', 'trendingProducts', 'bestSellers', 'categories'));
    }
}
