<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\UserOrder;

class AdminController extends Controller
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

    public function index()
    {
        $products = Product::paginate(2);
        $products = Product::all();
        $categories = Category::all(); 
        
        return view('admin.addproduct', compact('products', 'categories')); 
    }

 
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.updateproduct', compact('product', 'categories'));
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_image && file_exists(public_path($product->product_image))) {
            unlink(public_path($product->product_image));
        }

        $product->delete();

        return redirect()->route('admin.addproduct')->with('success', 'Product deleted successfully!');
    }

    public function updateProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.updateproduct', compact('product','categories'));
    }

    public function postUpdateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id); 

        $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_quantity' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_category' => 'required|string',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        if ($request->hasFile('product_image')) {
            $destinationPath = public_path('uploads/products');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

           
            if ($product->product_image && file_exists(public_path($product->product_image))) {
                unlink(public_path($product->product_image));
            }

            $imageName = time().'_'.$request->file('product_image')->getClientOriginalName();
            $request->file('product_image')->move($destinationPath, $imageName);
            $product->product_image = 'uploads/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.addproduct')->with('success','Product updated successfully!');
    }


    public function viewUser()
    {
        $users = User::all();
        return view('admin.viewuser', compact('users'));
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.updateuser', compact('user'));
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role'  => 'nullable|string|max:50', 
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        $user->save();

        return redirect()->route('admin.viewuser')
                         ->with('user_message', 'User updated successfully!');
    }

   
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.viewuser')
                         ->with('user_message', 'User deleted successfully!');
    }

    public function dashboard()
    {
    return view('admin.dashboard'); 
    }


public function viewOrder()
{
    $orders = \App\Models\UserOrder::with(['user', 'products', 'items'])->get();

    return view('admin.vieworder', compact('orders'));
}




public function approveOrder($id)
{
    $order = UserOrder::findOrFail($id);
    $order->status = 'approved';
    $order->save();

    return redirect()->route('admin.vieworder')->with('success', 'Order approved successfully!');
}

public function rejectOrder($id)
{
    $order = UserOrder::findOrFail($id);
    $order->status = 'rejected';
    $order->save();

    return redirect()->route('admin.vieworder')->with('success', 'Order rejected successfully!');
}

}
