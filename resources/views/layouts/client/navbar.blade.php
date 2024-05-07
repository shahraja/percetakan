<nav class="navbar navbar-expand-lg bg-body-tertiary px-5">
  <div class="container-fluid">
    <img class="img img-fluid" width="50" src="{{asset('assets/img/logo-2.png')}}" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
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
        <a href="{{route('login')}}" class="btn btn-success bg-utama">login</a>
    </div>
  </div>
</nav>