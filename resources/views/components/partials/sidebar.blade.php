<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Cihuy</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('transaction')}}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Transaction</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('product')}}">
            <i class="fas fa-fw fa-cube"></i>
            <span>Product</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('category')}}">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Category</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('history')}}">
            <i class="fas fa-fw fa-history"></i>
            <span>History Order</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('product-sold')}}">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Product Sold</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('user')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span></a>
    </li>
    @elseif (Auth::user()->role == 'cashier')
    <li class="nav-item">
        <a class="nav-link" href="{{route('transaction')}}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Transaction</span></a>
    </li>
    @elseif (Auth::user()->role == 'staff')
    <li class="nav-item">
        <a class="nav-link" href="{{route('product')}}">
            <i class="fas fa-fw fa-cube"></i>
            <span>Product</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('category')}}">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Category</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->