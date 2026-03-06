<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id') // join categories
            ->where('carts.user_id', $userId)
            ->select(
                'carts.*',
                'products.product_name',
                'products.product_price',
                'products.product_image',
                'categories.category_name' // select category_name
            )
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $userId = Auth::id();
        $quantity = max(1, intval($request->input('quantity', 1)));

        $cartItem = DB::table('carts')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            DB::table('carts')
                ->where('id', $cartItem->id)
                ->increment('quantity', $quantity);
        } else {
            DB::table('carts')->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $productId)
    {
        $userId = Auth::id();
        $quantity = max(1, intval($request->input('quantity', 1)));

        $cartItem = DB::table('carts')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            DB::table('carts')
                ->where('id', $cartItem->id)
                ->update([
                    'quantity' => $quantity,
                    'updated_at' => now(),
                ]);
        }

        return back()->with('success', 'Cart updated successfully!');
    }

    public function remove($cartId)
    {
        $userId = Auth::id();

        DB::table('carts')
            ->where('id', $cartId)
            ->where('user_id', $userId)
            ->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}
