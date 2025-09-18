@extends('layouts.default')

@section("title","Shopping Cart")

@section("style")
<style>
    .card:hover {
        transform: scale(1.02);
        transition: 0.3s;
    }
    .cart-summary {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section("content")
<main class="container my-5" style="max-width: 1000px;">
    <div class="row g-4">
        {{-- Left: Cart Items --}}
        <div class="col-lg-8">
            <h2 class="mb-4">Your Shopping Cart 🛒</h2>

            @forelse($cartItems as $cart)
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-4">
                            <img src="{{ $cart->product->product_image ?? '' }}" 
                                 class="img-fluid rounded-start" 
                                 alt="{{ $cart->product->product_title ?? 'Product Image' }}" 
                                 style="height:180px; object-fit:cover;">
                        </div>
                        <div class="col-md-5">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ $cart->product ? route('product_details', $cart->product->id) : '#' }}" 
                                       class="text-decoration-none">
                                         {{ $cart->product->product_title ?? 'Unknown Product' }}
                                    </a>
                                </h5>
                                <p class="card-text mb-1">
                                    <strong>Price:</strong> ${{ $cart->price ?? ($cart->product->product_price ?? 0) }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Quantity:</strong> {{ $cart->quantity ?? 1 }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 text-end pe-3">
                            <form action="{{ route('cart.remove', $cart->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2"
                                    onclick="return confirm('Are you sure you want to remove this item from your cart?');">
                                    Remove
                                </button>
                            </form>
                            <p class="mt-3 fw-bold">
                                ${{ number_format(($cart->price ?? ($cart->product->product_price ?? 0)) * $cart->quantity, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    Your cart is empty.
                </div>
            @endforelse
        </div>

        {{-- Right: Cart Summary --}}
        @if($cartItems->count() > 0)
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="mb-3">Order Summary</h4>
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $cart)
                        @php $price = $cart->price ?? ($cart->product->product_price ?? 0); @endphp
                        @php $grandTotal += $price * $cart->quantity; @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $cart->product->product_title ?? 'Unknown Product' }} × {{ $cart->quantity }}</span>
                            <span>${{ number_format($price * $cart->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span>${{ number_format($grandTotal, 2) }}</span>
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 mt-4">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
