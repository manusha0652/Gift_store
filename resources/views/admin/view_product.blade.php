<!DOCTYPE html>
<html>
  <head> 
  @include('admin.css')

  <style>
   th{
    background-color: skyblue !important;
    border-right:  2px solid yellowgreen !important;
    border: 2px solid yellowgreen !important;
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

    .section{
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        margin-bottom: 20px !important;
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

          <div class="section">
         
            <div class="header"> <h1>View Products</h1>
        </div>
            <div class="search">

          <form action="{{ url('search_product') }}" method="GET" class="form-inline my-2 my-lg-0">
            @csrf
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search by title or category" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <button class="btn btn-outline-danger my-2 my-sm-0" type="button" onclick="clearSearch()" style="margin-left: 5px;">Clear</button>

            </form>

            </div>
        </div>
           
              @if($data->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No products found for this search: "{{ request('search') }}".
                </div>
                @else
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
                        <a href="{{ url('delete_product', $product->id) }}"  onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                        </td>

                       
    
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <div class="pagination"> {{ $data->onEachSide(1)->links() }}

            </div>
           

          </div>    
      </div>
    </div>
   
<script>
    function clearSearch() {
        // Clear the search input and reload the page
        document.querySelector('input[name="search"]').value = '';
        window.location.href = "{{ url('view_product') }}"; // Redirect to the view product page
    }
    function confirmation(ev) {
        ev.preventDefault(); // Prevent the default action (navigation)
        var link = ev.currentTarget.getAttribute('href'); // Get the href attribute of the clicked link
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to revert this ",
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