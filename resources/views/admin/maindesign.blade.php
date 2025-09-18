<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page_title', 'Dark Bootstrap Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
</head>
<body>
<header class="header">   
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="What are you searching for...">
                        <button type="submit" class="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <a href="{{ route('dashboard') }}" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase">
                        <strong class="text-primary">Dark</strong><strong>Admin</strong>
                    </div>
                    <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
                </a>
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>

            <!-- Log out -->
            <div class="list-inline-item logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </nav>
</header>

<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
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
    <!-- Sidebar Navigation End-->

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">@yield('page_title', 'Dashboard')</h2>
            </div>
        </div>

        <section class="no-padding-top no-padding-bottom">
            @yield('dashboard')
            @yield('add_category')
            @yield('view_category')
            @yield('update_category')
            @yield('add_product')
        </section>

        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom">2018 &copy; Your company. Download From 
                        <a target="_blank" href="https://templateshub.net">Templates Hub</a>.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- JavaScript files -->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/js/charts-home.js') }}"></script>
<script src="{{ asset('admin/js/front.js') }}"></script>
</body>
</html>
