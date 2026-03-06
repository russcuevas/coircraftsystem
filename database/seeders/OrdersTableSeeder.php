<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orders;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'order_number' => 'ORD-1001',
                'product_id' => 1,
                'user_id' => 1,
                'quantity' => 2,
                'price' => 900,
                'payment_method' => 'GCASH',
                'payment_proof' => 'proof1.jpg',
                'payment_status' => 'paid',
                'delivery_method' => 'Pick up',
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_number' => 'ORD-1002',
                'product_id' => 2,
                'user_id' => 2,
                'quantity' => 1,
                'price' => 320,
                'payment_method' => 'COD',
                'payment_proof' => null,
                'payment_status' => 'not paid',
                'delivery_method' => 'Delivery',
                'status' => 'for delivery',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($orders as $order) {
            Orders::create($order);
        }
    }
}
