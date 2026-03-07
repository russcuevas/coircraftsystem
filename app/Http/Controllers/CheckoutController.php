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

    public function CheckoutRequest(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable',
            'delivery_method' => 'required|string',
        ]);

        $paymentProofPath = null;

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('payment_proofs'), $fileName);
            $paymentProofPath = $fileName;
        }

        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $user->id)
            ->select('carts.*', 'products.product_price', 'products.product_sales', 'products.product_stocks')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));

            foreach ($cartItems as $item) {
                DB::table('orders')->insert([
                    'order_number' => $orderNumber,
                    'product_id' => $item->product_id,
                    'user_id' => $user->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product_price * $item->quantity,
                    'payment_method' => $validated['payment_method'],
                    'payment_proof' => $paymentProofPath,
                    'payment_status' => 'not paid',
                    'delivery_method' => $validated['delivery_method'],
                    'status' => 'Pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('products')
                    ->where('id', $item->product_id)
                    ->increment('product_sales', $item->quantity);

                $newStock = $item->product_stocks - $item->quantity;
                $newStatus = ($newStock <= 0) ? 'Not Available' : (($newStock <= 10) ? 'Low Stocks' : 'Available');

                DB::table('products')
                    ->where('id', $item->product_id)
                    ->update([
                        'product_stocks' => $newStock,
                        'product_status' => $newStatus,
                    ]);
            }

            // clear cart
            DB::table('carts')->where('user_id', $user->id)->delete();

            DB::commit();

            return redirect('/transactions')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $user->update($request->only('fullname', 'email', 'address', 'phone_number'));
        return response()->json(['success' => true]);
    }

}
