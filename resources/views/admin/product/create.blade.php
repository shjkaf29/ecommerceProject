@extends('admin.layouts.app')

@section('page_title', 'Add Product')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
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

@endsection
