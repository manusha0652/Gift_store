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
    .add_category{
        padding: 30px;
        text-align: center;
    }
    .add_category input[type="text"]{
        width: 300px;
        height: 40px;
        border-radius: 5px;
        border: 1px solid black;
        padding: 5px;
       margin-left: 50px
       
    }
   
    .add_category input[type="submit"]{
       
        color: white;
        height: 40px;
        width: 130px;
        border-radius: 5px;
    }
    .add_category input[type="submit"]:hover{
        background-color: red;
    }
    .table_deg{
        text-align: 
        center;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 50px;
        width: 50%;
        
    }

    th{
        background-color: skyblue;
        padding: 15px;
        font-weight: bold;
        color: white;
        border: 1px solid skyblue;

    }
    td{
        color: white;
        padding: 10px;
        border: 1px solid skyblue;

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
                    <h1> Add Category</h1>
                </div>   
          <div class="add_category">
               
                <form action="{{ url('add_category') }}" method="POST">
                    @csrf
                    <input type="text" name="category" placeholder="Add Category" required>
                    <input type="submit" class="btn btn-primary" value="Add Category">
             </div>
             <table class="table_deg">
                <tr>
                    <th >Category name</th>
                    <th >Delete</th>
                    <th >Edit</th>

                </tr>
                @foreach ($data as $data )
                <tr>
                    <td>{{ $data->category_name }}</td>
                    <td >
                        <a class="btn btn-success" href="{{ url('edit_category',$data->id) }}">Edit</a>
                    </td>
                    <td >
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_category',$data->id) }}">Delete</a>
                    </td>
                   
                    
                </tr>
                @endforeach

             
             </table>

          </div>    
      </div>
    </div>
    <!-- JavaScript files-->

    <script>
        function confirmation(ev) {
            ev.preventDefault(); // Prevent the default action (navigation)
            var link = ev.currentTarget.getAttribute('href'); // Get the href attribute of the clicked link
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link; // Redirect to the link if confirmed
                } 
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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