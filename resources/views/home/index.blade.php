<!DOCTYPE html>


<head>
 @include('home.css')
 <style>
  /* styles.css */
  .product-card {
  position: relative;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  background: #fff;
  overflow: hidden;
  transition: all 0.3s ease;
  height: 100%;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.product-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  z-index: 2;
}

.product-badge span {
  background-color: #ff4e00;
  color: white;
  font-size: 12px;
  font-weight: bold;
  padding: 5px 12px;
  border-radius: 20px;
  text-transform: uppercase;
}

.product-img {
  padding: 20px;
  background: #f8f9fa;
  text-align: center;
  height: 220px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-img img {
  max-height: 180px;
  object-fit: contain;
}

.product-info {
  padding: 15px;
}

.product-title {
  margin-bottom: 10px;
  font-weight: 600;
  font-size: 16px;
  color: #333;
  height: 40px;
  overflow: hidden;
}

.product-price {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid #eee;
}

.price-label {
  font-size: 14px;
  color: #666;
}

.price-amount {
  font-size: 16px;
  font-weight: bold;
  color: #ff4e00;
}

.product-actions {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin-top: 10px;
}

.btn {
  padding: 8px 12px;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
  text-align: center;
  transition: all 0.3s;
  flex: 1;
}

.btn-view {
  background-color: #f8f9fa;
  color: #333;
  border: 1px solid #ddd;
}

.btn-view:hover {
  background-color: #e9ecef;
}

.btn-cart {
  background-color: #ff4e00;
  color: white;
  border: none;
}

.btn-cart:hover {
  background-color: #e04500;
}

.product-actions {
  display: flex;
  gap: 10px;
}

/* Only add media query for button layout which Bootstrap doesn't handle */
@media (max-width: 576px) {
  .product-actions {
    flex-direction: column;
  }
}


 </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
   @include('home.header')
    <!-- end header section -->
    <!-- slider section -->

    @include('home.slider')

    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->

 @include('home.product')

  <!-- end shop section -->







  <!-- contact section -->

 @include('home.contact')

  <!-- end contact section -->

  @include('home.footer') 

  <!-- info section -->

 

</body>

