@extends('admin.maindesign')

@section('page_title', 'View Categories')

@section('view_category')

@if(session('deletecategory_message'))
    <div>
        {{session('deletecategory_message')}}
    </div>
@endif

<div class="container-fluid mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">All Categories</h5>
        </div>
        <div class="card-body">
            @if(\App\Models\Category::count() > 0)
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Category::all() as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->category }}</td>
                                <td>{{ $category->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ $category->updated_at->format('d-m-Y H:i') }}</td>
                               <td>
                                        <a href="{{ route('admin.editcategory', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.categorydelete', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                Delete
                                            </button>
                                        </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No categories found.</div>
            @endif
        </div>
    </div>

</div>

@endsection
