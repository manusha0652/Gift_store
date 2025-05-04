<!DOCTYPE html>
<html>
  <head> 
  @include('admin.css')

<style>
    input, textarea, select {
        background-color: white !important;
        color: black  !important;
    }
</style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
           <div class="row">
              <div class="col-lg-12">
                <div class="header"> <h1 >Add Product</h1></div>
               
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <form action="{{ url('update_product', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="product_name" style="color: white;">Product Title</label>
                    <input id="product_title" type="text" name="title" class="form-control" value="{{ $data->title }}" required>
                    
                    <label for="product_description" style="color: white;">Product Description</label>
                    <textarea id="product_description" name="description" class="form-control" required>{{ $data->description }}</textarea>
                    
                    <label for="product_category" style="color: white;">Product Category</label>
                    <select id="product_category" name="category" class="form-control" required>
                      <option value="">Select Category</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->category_name }}" {{ $data->category == $category->category_name ? 'selected' : '' }}>
                          {{ $category->category_name }}
                        </option>
                      @endforeach
                    </select>
                    
                    <label for="product_price" style="color: white;">Product Price</label>
                    <input id="product_price" type="number" name="price" class="form-control" value="{{ $data->price }}" required>
                    
                    <label for="product_quantity" style="color: white;">Product Quantity</label>
                    <input id="product_quantity" type="number" name="quantity" class="form-control" value="{{ $data->quantity }}" required>
                    
                    <label for="product_image" style="color: white;">Product Image</label>
                    <input id="product_image" type="file" name="image" class="form-control">
                    <img src="{{ asset('product/' . $data->image) }}" alt="Product Image" style="max-width: 100px; margin-top: 10px;">
                    
                    <button type="submit" class="btn btn-success mt-3">Update Product</button>
                  </form>
          </div>    
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
  </body>
</html>