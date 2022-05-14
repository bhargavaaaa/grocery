<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->segment(1) == "home") active @endif">
        <a class="nav-link" href="{{ url('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item @if(request()->segment(1) == "products") active @endif">
        <a class="nav-link" href="{{ url('products') }}">
            <i class="fas fa-fw fa-shopping-basket"></i>
            <span>Available stuff</span></a>
    </li>

    <li class="nav-item @if(request()->segment(1) == "used-products") active @endif">
        <a class="nav-link" href="{{ url('used-products') }}">
            <i class="fas fa-fw fa-hourglass"></i>
            <span>Used stuff</span></a>
    </li>

    <li class="nav-item @if(request()->segment(1) == "spoiled-products") active @endif">
        <a class="nav-link" href="{{ url('spoiled-products') }}">
            <i class="fas fa-fw fa-trash"></i>
            <span>Spoiled stuff</span></a>
    </li>

    <li class="nav-item @if(request()->segment(1) == "purchase-list") active @endif">
        <a class="nav-link" href="{{ url('purchase-list') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Will purchase list</span></a>
    </li>

    <li class="nav-item @if(request()->segment(1) == "expence") active @endif">
        <a class="nav-link" href="{{ url('expence') }}">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Expence</span></a>
    </li>
</ul>