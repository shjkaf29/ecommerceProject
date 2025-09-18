@extends('admin.maindesign')

@section('page_title', 'Add Product')

@section('add_product')

<div class="container-fluid mt-4">

    {{-- Success Message --}}
    @if(session('product_message'))
        <div class="alert alert-success">
            {{ session('product_message') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add Product Form --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.postaddproduct') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="product_title">Product Title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" value="{{ old('product_title') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="product_price">Price ($)</label>
                    <input type="number" step="0.01" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" value="{{ old('product_price') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="product_quantity">Quantity</label>
                    <input type="number" name="product_quantity" id="product_quantity" class="form-control" placeholder="Enter quantity" value="{{ old('product_quantity') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="product_description">Description</label>
                    <textarea name="product_description" id="product_description" class="form-control" rows="4" placeholder="Enter product description">{{ old('product_description') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="product_category">Category</label>
                    <select name="product_category" id="product_category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('product_category') == $category->id ? 'selected' : '' }}>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image" id="product_image" class="form-control">
                </div>

                <button type="submit" class="btn btn-success mt-2">Add Product</button>
            </form>
        </div>
    </div>

    {{-- Existing Products Table --}}
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
                    @forelse(\App\Models\Product::all() as $index => $product)
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

</div>

@endsection
