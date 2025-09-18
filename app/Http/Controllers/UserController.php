<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\UserOrder;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->user_type === 'user') {
                return view('dashboard');
            } elseif ($user->user_type === 'admin') {
                return view('admin.dashboard');
            }
        }
        return redirect()->route('login');
    }

    public function home()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('product_details', compact('product'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cartItem = ProductCart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cartItem = new ProductCart();
            $cartItem->user_id = Auth::id();
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
            $cartItem->price = $product->product_price;
            $cartItem->save();
        }

        return redirect()->back()->with("success", "Product added to cart successfully.");
    }

    public function cartProducts()
    {
        $userId = Auth::id();

        $cartItems = ProductCart::where('user_id', $userId)
            ->whereHas('product')   
            ->with('product')
            ->get();

        $grandTotal = $cartItems->sum(fn($item) => ($item->price ?? $item->product->product_price) * $item->quantity);

        return view('cart', compact('cartItems', 'grandTotal'));
    }

    public function updateCart(Request $request, $id)
    {
        $cartItem = ProductCart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->action === 'increase') {
            $cartItem->quantity += 1;
        } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        }

        $cartItem->save();

        return back()->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart($id)
    {
        $cartItem = ProductCart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cartproducts')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cartproducts')->with('error', 'Item not found.');
    }

   public function checkout(Request $request)
{
    $user = Auth::user();
    $cart = session()->get('cart', []); 

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    $order = UserOrder::create([
        'user_id' => $user->id,
        'status' => 'pending',
    ]);

    foreach ($cart as $productId => $details) {
        $order->products()->attach($productId, ['quantity' => $details['quantity']]);
    }

    session()->forget('cart');

    return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
}



}
