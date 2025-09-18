<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\UserOrder;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
     public function addCategory()
    {
        return view('admin.addcategory');
    }


    public function postAddCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        Category::create(['category' => $request->category]);

        return redirect()->route('admin.viewcategory')
                         ->with('category_message', 'Category added successfully!');
    }


    public function viewCategory()
    {
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.viewcategory')
                         ->with("deletecategory", "Category deleted successfully!");
    }


    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view("admin.updatecategory", compact('category'));
    }


    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->route('admin.viewcategory')
                         ->with("updatecategory", "Category updated successfully!");
    }


    
    public function addProduct()
    {
        $categories = Category::all(); 
        return view('admin.addproduct', compact('categories'));
    }

    public function postAddProduct(Request $request)
    {
        $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_quantity' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_category' => 'required|string',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;

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

        return redirect()->route('admin.viewproduct')->with('success', 'Product added successfully!');
    }
}
