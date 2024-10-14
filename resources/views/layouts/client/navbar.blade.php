<nav class="navbar navbar-expand-lg bg-body-tertiary px-5">
  <div class="container-fluid">
    <img class="img img-fluid" width="50" src="{{asset('assets/img/logo-2.png')}}" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars" style="color: black;"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item ms-5">
          <a class="nav-link mx-5" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item dropdown mx-5">
          <a class="nav-link dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Produk
          </a>
          <ul class="dropdown-menu " style="width: 400px"  aria-labelledby="dropdownMenuButton1">
            <div class="row">
              @foreach ($products as $product)
                <li class="col-6 gap-1">
                  <a class="dropdown-item " href="{{route('detail_product', $product->id)}}">
                    <p>{{$product->judul}}</p>
                  </a>
                </li>
              @endforeach
            </div>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-5" href="{{route('about')}}">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-5" href="{{route('contact')}}">Kontak</a>
        </li>
      </ul>
      @guest
          <a href="{{ route('login') }}" class="btn btn-success bg-utama">Login</a>
      @else
      <a href="{{route('cart2')}}" class="btn btn-success bg-utama me-4"><i class="fa-solid fa-bag-shopping"></i></a>
      <a href="{{route('cart')}}" class="btn btn-success bg-utama me-4"><i class="fa-solid fa-cart-shopping"></i></a>
      <div class="btn-group">
            <a href="#" class="btn btn-success bg-utama dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('user.feedback') }}">Feedback</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" 
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
      @endguest
    </div>
  </div>
</nav>

<style>
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(0, 0, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }
</style>


<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>