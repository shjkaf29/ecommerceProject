@extends('admin.maindesign')

@section('page_title', 'Edit Category')

@section('edit_category')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updatecategory', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ $category->category }}">
                </div>
                <button type="submit" class="btn btn-success mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
