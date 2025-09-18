@extends('admin.layouts.app')

@section('page_title', 'Add Product')

@section('content')
 <div class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Existing Products</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col">Product Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col" style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->product_title }}</td>
                            <td>${{ number_format($product->product_price, 2) }}</td>
                            <td>{{ $product->product_quantity }}</td>
                            <td>{{ Str::limit($product->product_description, 40) }}</td>
                            <td>{{ $product->category?->category ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.updateproduct', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.deleteproduct', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
