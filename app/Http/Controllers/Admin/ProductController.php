<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){

        $products=Product::orderBy('id','desc')->paginate();
        return view('admin.product.index',compact('products'));
    }

    public function create(){

        $categories=Category::all();
        return view('admin.product.create',compact('categories'));
    }

    public function store(Request $request){

          $request->validate([
            'product_title'       => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_quantity'    => 'required|integer',
            'product_price'       => 'required|numeric',
            'product_category'    => 'required|string',
            'product_image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product                      = new Product();
        $product->product_title       = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity    = $request->product_quantity;
        $product->product_price       = $request->product_price;

        if ($request->hasFile('product_image')) {
            $destinationPath = public_path('uploads/products');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $imageName = time() . '_' . $request->file('product_image')->getClientOriginalName();
            $request->file('product_image')->move($destinationPath, $imageName);

            $product->product_image = 'uploads/products/' . $imageName;
        }

        $product->product_category = $request->product_category;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product added successfully!');

    }
}
