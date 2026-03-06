<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        Categories::create(['category_name' => 'Gardening']);
        Categories::create(['category_name' => 'Construction']);
        Categories::create(['category_name' => 'Home Decor']);
        Categories::create(['category_name' => 'Agriculture']);
    }
}
