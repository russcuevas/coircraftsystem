<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carts;
use Carbon\Carbon;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = [
            [
                'product_id' => 1,
                'user_id' => 1,
                'quantity' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'user_id' => 1,
                'quantity' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 3,
                'user_id' => 2,
                'quantity' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 4,
                'user_id' => 2,
                'quantity' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert each cart individually using Carts::create()
        foreach ($carts as $cart) {
            Carts::create($cart);
        }
    }
}
