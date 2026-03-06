<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartCountsController extends Controller
{
    public function count()
    {
        $cartCount = 0;

        if (Auth::check()) {
            // Count unique product IDs for the logged-in user
            $cartCount = DB::table('carts')
                ->where('user_id', Auth::id())
                ->distinct('product_id')
                ->count('product_id');
        }

        return response()->json(['cartCount' => $cartCount]);
    }
}
