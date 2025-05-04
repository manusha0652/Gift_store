<!DOCTYPE html>
<html>
  <head> 
  @include('admin.css')
  <style type="text/css">
    .cate{
        padding: 20px;
        text-align: center;
        font-size: 30px;
        color: white;
    }
    .edit_category{
        padding: 30px;
        text-align: center;
    }
    .edit_category input[type="text"]{
        width: 300px;
        height: 40px;
        border-radius: 5px;
        border: 1px solid black;
        padding: 5px;
       margin-left: 50px
       
    }
   
    .edit_category input[type="submit"]{
       
        color: white;
        height: 40px;
        width: 130px;
        border-radius: 5px;
    }
    .edit_category input[type="submit"]:hover{
        background-color: red;
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
           
 <div class="cate">
    <h1>Update Category</h1>
    </div>
    <div class="edit_category">
    <form action="{{ url('update_category',$data->id) }}" method="POST">
        <input type="text" name="category"  value="{{ $data->category_name }}">
        @csrf
                   
         <input type="submit" class="btn btn-primary" value="Edit Category">
    </form>
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