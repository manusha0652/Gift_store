<!DOCTYPE html>
<html>
  <head> 
  @include('admin.css')

  <style>
   th{
    background-color: skyblue !important;
    border-right:  2px solid yellowgreen !important;
     color: black;
    
   } 
    td{
     color: white !important;
     border: 2px solid yellowgreen !important;
    }
    .pagination{
        display: flex !important;
        justify-content: center !important;
        margin-top: 20px !important;
       
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
            <div class="header"> <h1>View Products</h1></div>
           
            <table class="table table-bordered">
                <thead class="table">
                    <tr >
                     
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Update</th>
                        <th>Delete</th>
                       
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $product)
                    <tr>
                       
                        <td>{{ $product->title }}</td>
                        <td>{!! Str::limit($product->description,50)  !!}</td>
                        <td><img height="100px" width="120px" src="{{ asset('product/' . $product->image) }}" alt="{{ $product->title }}" width="50"></td>
                        <td>{{ $product->price }} LKR</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                        <a href="{{ url('update_product', $product->id) }}" class="btn btn-success">Update</a>
                            
                        </td>
                        <td>
                        <a href="{{ url('delete_product', $product->id) }}" class="btn btn-danger">Delete</a>
                        </td>

                       
    
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination"> {{ $data->onEachSide(1)->links() }}

            </div>
           

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