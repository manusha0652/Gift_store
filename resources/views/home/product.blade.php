<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      
      <div class="container">
  <div class="row">
    @foreach($products as $product)
      <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="product-card">
          <!-- Badge for new products -->
          <div class="product-badge">
            <span>New</span>
          </div>
          
          <!-- Product image container -->
          <div class="product-img">
            <a href="{{ route('product.details', $product->id) }}">
              <img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->title }}" class="img-fluid">
            </a>
          </div>
          
          <!-- Product information -->
          <div class="product-info">
            <h5 class="product-title">{{ $product->title }}</h5>
            <div class="product-price">
              <span class="price-label">Price</span>
              <span class="price-amount">LKR {{ number_format($product->price, 2) }}</span>
            </div>
            
            <!-- Action buttons -->
            <div class="product-actions">
              <a href="{{ route('product.details', $product->id) }}" class="btn btn-view">View Details</a>
      
            </div>
            <div class="product-actions">
             
              <a href="{{ route('product.addToCart', $product->id) }}" class="btn btn-cart">Add to Cart</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
  
  </section>