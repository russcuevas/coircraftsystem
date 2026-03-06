<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function CheckoutPage()
    {
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', Auth::id())
            ->select('carts.*', 'products.product_name', 'products.product_price', 'products.product_image')
            ->get();

        return view('checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'delivery_method' => 'required|string',
        ]);

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $user->id)
            ->select('carts.*', 'products.product_price')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            foreach ($cartItems as $item) {
                DB::table('orders')->insert([
                    'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                    'product_id' => $item->product_id,
                    'user_id' => $user->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product_price,
                    'payment_method' => $validated['payment_method'],
                    'payment_proof' => $paymentProofPath,
                    'payment_status' => 'Pending',
                    'delivery_method' => $validated['delivery_method'],
                    'status' => 'Pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('carts')->where('user_id', $user->id)->delete();

            DB::commit();

            return redirect('/shop')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
