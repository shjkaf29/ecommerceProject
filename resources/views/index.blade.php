@extends("frontend.layouts.app")
@section('content')
<div class="hero_area">
  <!-- header section -->
  <header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="{{ route('index') }}">
        <span>E-Commerce</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Shop</a>
          </li>
        </ul>

        <div class="user_option">
          @auth
          <!-- Show when logged in -->
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
          <a href="{{ route('cartproducts') }}">
            <i class="fa fa-shopping-cart"></i> <span>Cart</span>
          </a>
          @else
          <!-- Show when not logged in -->
          <a href="{{ route('login') }}">
            <i class="fa fa-user"></i> <span>Login</span>
          </a>
          <a href="{{ route('register') }}">
            <i class="fa fa-user"></i> <span>Sign Up</span>
          </a>
          @endauth
        </div>
      </div>
    </nav>
  </header>

  <!-- end header section -->

  <!-- slider section (kept same) -->
  <section class="slider_section">
    <div class="slider_container">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>Welcome To Our <br> Gift Shop</h1>
                    <p>
                      Sequi perspiciatis nulla reiciendis, rem, tenetur impedit, eveniet non necessitatibus error
                      distinctio mollitia suscipit.
                    </p>
                    <a href="">Contact Us</a>
                  </div>
                </div>
                <div class="col-md-5 ">
                  <div class="img-box">
                    <img style="width:600px" src="images/image3.jpeg" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end slider section -->
</div>

<!-- shop section -->
<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Latest Products</h2>
    </div>

    <div class="row">
      @if($products->count() > 0)
      @foreach($products as $product)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="box">
          <!-- This is the link for product description -->
          <a href="{{ route('product_details',$product->id) }}">
            <div class="img-box">
              <img src="{{ asset($product->product_image) }}"
                alt="{{ $product->product_title }}">
            </div>
            <div class="detail-box">
              <h6>{{ $product->product_title }}</h6>
              <h6>
                Price
                <span>${{ number_format($product->product_price, 2) }}</span>
              </h6>
            </div>
            <div class="new">
              <span>New</span>
            </div>
          </a>
        </div>
      </div>
      @endforeach
      @else
      <p>No products available.</p>
      @endif
    </div>
  </div>
</section>
<!-- end shop section -->

<!-- contact section (kept same) -->
<section class="contact_section ">
  <div class="container px-0">
    <div class="heading_container ">
      <h2 class="">Contact Us</h2>
    </div>
  </div>
  <div class="container container-bg">
    <div class="row">
      <div class="col-lg-7 col-md-6 px-0">
        <div class="map_container">
          <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France"
              width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-5 px-0">
        <form action="#">
          <div><input type="text" placeholder="Name" /></div>
          <div><input type="email" placeholder="Email" /></div>
          <div><input type="text" placeholder="Phone" /></div>
          <div><input type="text" class="message-box" placeholder="Message" /></div>
          <div class="d-flex "><button>SEND</button></div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->

<!-- info section (kept same) -->
<section class="info_section  layout_padding2-top">
  <div class="social_container">
    <div class="social_box">
      <a href=""><i class="fa fa-facebook"></i></a>
      <a href=""><i class="fa fa-twitter"></i></a>
      <a href=""><i class="fa fa-instagram"></i></a>
      <a href=""><i class="fa fa-youtube"></i></a>
    </div>
  </div>
  <div class="info_container ">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <h6>ABOUT US</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="info_form ">
            <h5>Newsletter</h5>
            <form action="#">
              <input type="email" placeholder="Enter your email">
              <button>Subscribe</button>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <h6>NEED HELP</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="col-md-6 col-lg-3">
          <h6>CONTACT US</h6>
          <div class="info_link-box">
            <a href=""><i class="fa fa-map-marker"></i> <span> Gb road 123 london Uk </span></a>
            <a href=""><i class="fa fa-phone"></i> <span>+01 12345678901</span></a>
            <a href=""><i class="fa fa-envelope"></i> <span> demo@gmail.com</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="#">E-Commerce Project</a>
      </p>
    </div>
  </footer>
</section>
@endsection