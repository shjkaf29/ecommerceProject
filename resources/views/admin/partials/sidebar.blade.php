<nav id="sidebar">
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ asset('admin/img/avatar-6.jpg') }}" alt="Admin Avatar" class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">Admin</h1>
            <p>E-Commerce</p>
        </div>
    </div>

    <!-- Sidebar Navigation Menus -->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active">
            <a href="{{ route('dashboard') }}"><i class="icon-home"></i>Home</a>
        </li>

        <li>
            <a href="#categoryDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>Category
            </a>
            <ul id="categoryDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('admin.addcategory') }}">Add Category</a></li>
                <li><a href="{{ route('admin.viewcategory') }}">View Category</a></li>
            </ul>
        </li>

        <li>
            <a href="#productDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>Products
            </a>
            <ul id="productDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('admin.addproduct') }}">Add Product</a></li>
                <li><a href="{{ route('admin.viewproduct') }}">View Product</a></li>
                <li><a href="{{ route('admin.vieworder') }}">View Order</a></li>
                <li><a href="{{ route('admin.viewuser') }}">View Users</a></li>
            </ul>
        </li>
    </ul>
</nav>