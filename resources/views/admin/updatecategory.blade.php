@extends('admin.maindesign')

@section('page_title', 'Update Category')

@section('update_category')

<div class="container-fluid mt-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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

    {{-- Update Category Form --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Update Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updatecategory', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="category">Category Name</label>
                    <input type="text" name="category" id="category" class="form-control"
                           value="{{ old('category', $category->category) }}" placeholder="Enter category name" required>
                </div>

                <button type="submit" class="btn btn-success mt-2">Update Category</button>
                <a href="{{ route('admin.viewcategory') }}" class="btn btn-secondary mt-2">← Back</a>
            </form>
        </div>
    </div>

</div>

@endsection
