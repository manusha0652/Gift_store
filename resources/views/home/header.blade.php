<header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <div class="logo">
          <a href="{{ route('home.index') }}">
            <span class="logoname" style="color: white; font-size: 24px; font-weight: bold;">SoulGift</span>
            <img src="{{ asset('images/nuw_logo.png') }}" alt="Logo" style="height:40px; ">
          </a>
          </div>
          
          <div class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('home.index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.product') }}">
                Shop
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.why_us') }}">
                Why Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.testimonial') }}">
                Testimonial
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.contact_us') }}">Contact Us</a>
            </li>
          </div>
          <div class="user_option">
            @guest
            <a href="{{url('/login')}}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
              Login
              </span>
            </a>
            <a href="{{url('/register')}}">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
              <span>
              Register
              </span>
            </a>
            @else
            <div>
            <div class="list-inline-item logout">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <input type="submit" value="Logout" style="background: none; color: white;">
              </form>
            </div>
            @endguest
            <a href="{{ route('home.cart') }}">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              <span style="color: orangered;">
                @auth
                  @if(!empty($count))
                  {{$count}}
                  @endif
                  
                @endauth
              </span>
            </a>
           </div>
          </div>
        </div>
      </nav>
    </header>