<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'product_image' => 'coir-mat.jpg',
                'product_name' => 'Coir Garden Mat',
                'product_description' => 'Eco-friendly coconut fiber mat for gardens.',
                'product_price' => 450,
                'product_stocks' => 9,
                'product_status' => "Low Stocks",
                'product_sales' => 10,
                'product_feature' => 'best seller',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => 2,
                'product_image' => 'coir-rope.jpg',
                'product_name' => 'Coir Rope',
                'product_description' => 'Strong natural fiber rope.',
                'product_price' => 320,
                'product_stocks' => 40,
                'product_status' => "Available",
                'product_sales' => 5,
                'product_feature' => 'trending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => 4,
                'product_image' => 'coco-peat.jpg',
                'product_name' => 'Coco Peat Block',
                'product_description' => 'Organic soil conditioner for agriculture.',
                'product_price' => 250,
                'product_stocks' => 60,
                'product_status' => "Available",
                'product_sales' => 3,
                'product_feature' => 'new',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($products as $product) {
            Products::create($product);
        }
    }
}
