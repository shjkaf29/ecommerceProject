@extends('layouts.admin')

@section('content')
<h2>Orders</h2>




@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Items</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr>
            <td>{{ $order->user->name }}</td>
            <td>
                @foreach($order->products as $product)
                    {{ $product->product_title }} (Qty: {{ $product->pivot->quantity }})<br>
                @endforeach
            </td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
                @if($order->status == 'pending')
                    <form action="{{ route('admin.order.approve', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>

                    <form action="{{ route('admin.order.reject', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                @else
                    <span class="text-muted">Action completed</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No orders found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
