<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InventoryController extends Controller
{
    public function InventoryPage()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name')
            ->get();
        $categories = DB::table('categories')->get();
        return view('admin.inventory', compact('products', 'categories'));
    }
    public function AddProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required|numeric',
            'product_stocks' => 'required|integer',
            'product_image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Logic for Status based on Stocks
        $stocks = $request->product_stocks;
        if ($stocks <= 0) {
            $status = "Not Available";
        } elseif ($stocks <= 10) {
            $status = "Low Stocks";
        } else {
            $status = "Available";
        }

        // Handle Image Upload
        $imageName = 'default.jpg';
        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('images'), $imageName);
        }

        DB::table('products')->insert([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_stocks' => $stocks,
            'product_status' => $status,
            'product_image' => $imageName,
            'product_sales' => 0,
            'product_feature' => 'none',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function UpdateProduct(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_stocks' => 'required|integer',
        ]);

        $stocks = $request->product_stocks;
        $status = ($stocks <= 0) ? "Not Available" : (($stocks <= 10) ? "Low Stocks" : "Available");

        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_stocks' => $stocks,
            'product_status' => $status,
            'updated_at' => now(),
        ];

        if ($request->hasFile('product_image')) {
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('images'), $imageName);
            $data['product_image'] = $imageName;
        }

        DB::table('products')->where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function DeleteProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if ($product) {
            $imagePath = public_path('images/' . $product->product_image);
            if ($product->product_image !== 'default.jpg' && File::exists($imagePath)) {
                File::delete($imagePath);
            }
            DB::table('products')->where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
