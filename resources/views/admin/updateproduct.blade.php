@extends('admin.maindesign')

@section('page_title', 'Update Product')

@section('content') {{-- make sure admin.maindesign has @yield('content') --}}

<div class="container mt-5" style="max-width:600px;">

    <h3 class="mb-4">Edit Product</h3>

    <a href="{{ route('admin.viewproduct') }}" class="btn btn-secondary mb-3">← Back</a>

    {{-- Success message --}}
    @if(session('success'))
    
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.postupdateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST') {{-- match your route method --}}

        <div class="mb-3">
            <label for="product_title">Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control"
                   value="{{ old('product_title', $product->product_title) }}" required>
        </div>

        <div class="mb-3">
            <label for="product_description">Description</label>
            <textarea name="product_description" id="product_description" class="form-control" rows="4" required>{{ old('product_description', $product->product_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="product_quantity">Quantity</label>
            <input type="number" name="product_quantity" id="product_quantity" class="form-control"
                   value="{{ old('product_quantity', $product->product_quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="product_price">Price</label>
            <input type="number" name="product_price" id="product_price" class="form-control"
                   value="{{ old('product_price', $product->product_price) }}" required>
        </div>

        <div class="mb-3">
            <label for="product_category">Category</label>
            <select name="product_category" id="product_category" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->product_category == $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_image">Image</label>
            <input type="file" name="product_image" id="product_image" class="form-control">
            @if($product->product_image)
                <img src="{{ asset($product->product_image) }}" alt="Product Image" style="max-width:150px; margin-top:10px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>

</div>

@endsection
