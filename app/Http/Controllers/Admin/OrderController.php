<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\UserOrder;

class OrderController extends Controller
{
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
