<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>
            Homepage
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('dashboard')}}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.user.index')}}" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>
            Kelola Akun
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.product.index')}}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Kelola Katalog
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.payment.index')}}" class="nav-link">
          <i class="nav-icon fas fa-money-bill"></i>
          <p>
            Kelola Pembayaran
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.cart.index')}}" class="nav-link">
          <i class="nav-icon fas fa-cart-shopping"></i>
          <p>
            Kelola Pesanan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
          @csrf
      </form>
      <a href="#" class="nav-link text-white @yield('')"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>
              Logout
          </p>
      </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->