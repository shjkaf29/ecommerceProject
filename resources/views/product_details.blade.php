<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>{{ $product->product_title }} - E-Commerce</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="/front_end/css/bootstrap.css" />

  <!-- Custom styles -->
  <link href="/front_end/css/style.css" rel="stylesheet" />
  <link href="/front_end/css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ route('index') }}">
          <span>E-Commerce</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Shop</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- end header section -->
  </div>

  <!-- Product Details Section -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ $product->product_title }}</h2>
      </div>

      {{-- Cart success message --}}
      @if(session('cart_message'))
        <div class="alert alert-success">
          {{ session('cart_message') }}
        </div>
      @endif

      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="{{ asset($product->product_image) }}" 
                 alt="{{ $product->product_title }}" 
                 class="img-fluid rounded shadow">
          </div>
        </div>
        <div class="col-md-6">
          <h4>Price: <span class="text-success">${{ number_format($product->product_price, 2) }}</span></h4>
          <p><strong>Description:</strong></p>
          <p>{{ $product->product_description }}</p>
          <p><strong>Quantity Available:</strong> {{ $product->product_quantity }}</p>

          {{-- Add to Cart Form --}}
          <form action="{{ route('add_to_cart', $product->id) }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
          </form>

          <a href="{{ route('index') }}" class="btn btn-secondary mt-3">← Back to Shop</a>
        </div>
      </div>
    </div>
  </section>
  <!-- End Product Details Section -->

  <!-- footer -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="#">E-Commerce Project</a>
      </p>
    </div>
  </footer>

  <script src="/front_end/js/jquery-3.4.1.min.js"></script>
  <script src="/front_end/js/bootstrap.js"></script>
  <script src="/front_end/js/custom.js"></script>
</body>

</html>
