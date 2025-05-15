<head>
  @include('home.css')
  <style>
    /* Custom modal header style */
   /* Enhanced modal styling */
.modal-header {
  background-color: #FF4E00;
  color: white;
  border-bottom: none;
  border-radius: 5px 5px 0 0;
}

.modal-footer {
  background-color: #FF4E00;
  border-top: none;
  margin-bottom: 0px;
}

.modal-content {
  border: none;
  border-radius: 8px;
  box-shadow: 0 0 0 3px rgba(255, 78, 0, 0.2), 0 10px 30px rgba(0, 0, 0, 0.2);
}

.modal-body .form-control {
  border-left: 3px solid #FF4E00;
}

.modal-body .form-control:focus {
  border-color: #FF4E00;
  box-shadow: 0 0 0 0.2rem rgba(255, 78, 0, 0.25);
}

.modal-footer .btn-primary {
  background-color: white;
  color: #FF4E00;
  border: none;
  font-weight: bold;
}

.modal-footer .btn-secondary {
  background-color: transparent;
  border: 1px solid white;
  color: white;
}

.modal-backdrop {
  z-index: 1050;
}

.modal {
  z-index: 1055;
}

.modal-dialog {
  z-index: 1060;
}



    /* Fix carousel overlapping issue */
    .carousel-item {
      display: none;
      transition: opacity 0.6s ease;
      position: relative;
    }

    .carousel-item.active {
      display: block;
    }
    
    /* Testimonial section styling */
    .client_section {
      position: relative;
      padding-top: 60px;
    }
    
    /* Share Your Story button styling */
    .share-story-btn {
      position: absolute;
      top: 20px;
      right: 50px;
      background-color: #FF4E00;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 30px;
      font-weight: bold;
      /* box-shadow: 0 4px 15px rgba(255, 78, 0, 0.3); */
      transition: all 0.3s ease;
    }
    
    .share-story-btn:hover {
      background-color: #ff6a2b;
      transform: translateY(-3px);
      /* box-shadow: 0 6px 20px rgba(255, 78, 0, 0.4); */
    }
    
    .share-story-btn i {
      margin-right: 8px;
    }
    
    /* Testimonial box styling */
    .box {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin: 20px 10px;
      transition: all 0.3s ease;
    }
    
    .box:hover {
      transform: translateY(-5px);
      /* box-shadow: 0 8px 25px rgba(255, 78, 0, 0.15); */
    }
    
    .client_name h5 {
      color: #FF4E00;
      font-weight: bold;
    }
    
    .fa-quote-left {
      color: #FF4E00;
      font-size: 24px;
    }
    
    /* Carousel controls styling */
    .carousel_btn-box a {
      background-color: #FF4E00;
      width: 20px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0.8;
      
    }
    
    .carousel_btn-box a:hover {
      opacity: 1;
      
    }
    
    .heading_container h2 {
      position: relative;
      padding-bottom: 15px;
    }
    
    .heading_container h2:after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background-color: #FF4E00;
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->

  <!-- client section -->
  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Testimonial
        </h2>
      </div>
      
      <!-- Moved button to top right with new styling -->
      <button type="button" class="share-story-btn" data-toggle="modal" data-target="#testimonialModal">
        <i class="fa fa-pencil"></i> Share Your Story
      </button>
    </div>
    
    <div class="add_testomonial"></div>
    <div class="container px-0">
      @if(count($testimonials) > 0)
      <div id="customCarousel2" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          @foreach($testimonials as $index => $testimonial)
          <div class="carousel-item @if($index == 0) active @endif">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                    {{ $testimonial->name }}
                  </h5>
                  <h6>
                    {{ $testimonial->title }}, {{ $testimonial->city }}
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
                {{ $testimonial->message }}
              </p>
            </div>
          </div>
          @endforeach
        </div>
        @if(count($testimonials) > 1)
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
        @endif
      </div>
      @else
      <p class="text-center">No testimonials available yet. Be the first to share your experience!</p>
      @endif
    </div>
  </section>
  <!-- end client section -->

  @include('home.footer')

  <!-- Testimonial Modal with improved styling -->
  <div class="modal fade" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="testimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ route('testimonial') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="testimonialModalLabel">Share Your Experience</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
              <label for="title">Your Title (e.g., Software Engineer)</label>
              <input type="text" class="form-control" name="title" required>
            </div>
            
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" class="form-control" name="city" required>
            </div>

            <div class="form-group">
              <label for="message">Your Testimonial</label>
              <textarea class="form-control" name="message" rows="4" required></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="js/custom.js"></script>
</body>
