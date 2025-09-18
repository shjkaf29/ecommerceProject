@extends('admin.maindesign')

@section('page_title', 'Add Category')

@section('add_category')

<div class="container-fluid mt-4">

    {{-- Success Message --}}
    @if(session('category_message'))
        <div class="alert alert-success">
            {{ session('category_message') }}
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

    {{-- Add Category Form --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.postaddcategory') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <input type="text" name="category" id="category" class="form-control" placeholder="Enter category name">
                </div>
                <button type="submit" class="btn btn-success mt-3">Add Category</button>
            </form>
        </div>
    </div>

    {{-- Existing Categories Table --}}
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Existing Categories</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col" style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Category::all() as $index => $cat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $cat->category }}</td>
                            <td>
                                {{-- Future: Add edit/delete buttons --}}
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
