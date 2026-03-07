<!-- ================= MOBILE NAV ================= -->
<header class="mobile-nav sticky-top d-lg-none">
    <button class="btn text-white fs-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <i class="bi bi-list"></i>
    </button>
    <h3 class="text-white fw-bold d-flex align-items-center gap-2 mb-0">
        <img src="{{ asset('images/logo.png') }}" alt="" style="height:40px;">
        CoirCraft PH
    </h3>
    <div style="width: 40px;"></div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title text-white d-flex align-items-center gap-2 mb-0">
            <img src="{{ asset('images/logo.png') }}" alt="" style="height:35px;">
            CoirCraft PH
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard.page') ? 'active' : '' }}" href="/admin/dashboard">
                <i class="bi bi-house-door me-3"></i> Dashboard
            </a>

            <a class="nav-link {{ request()->routeIs('admin.storefront.page') ? 'active' : '' }}" href="/admin/storefront">
                <i class="bi bi-shop me-3"></i> Storefront
            </a>

            <a class="nav-link {{ request()->routeIs('admin.inventory.page') ? 'active' : '' }}" href="/admin/inventory">
                <i class="bi bi-box-seam me-3"></i> Inventory
            </a>

            <a class="nav-link {{ request()->routeIs('admin.orders.page') ? 'active' : '' }}" href="/admin/orders">
                <i class="bi bi-receipt-cutoff me-3"></i> Orders
            </a>

            <a class="nav-link {{ request()->routeIs('admin.reports.page') ? 'active' : '' }}" href="/admin/reports">
                <i class="bi bi-bar-chart me-3"></i> Reports
            </a>
        </nav>
    </div>
</div>


<!-- ================= DESKTOP SIDEBAR ================= -->
<aside class="desktop-sidebar d-none d-lg-block">
    <div class="d-flex align-items-center mb-5 text-white">
        <i class="bi bi-leaf-fill fs-3 text-success"></i>
        <div>
            <strong class="d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="" style="height:30px;">
                CoirCraft PH
            </strong>
        </div>
    </div>

    <nav class="nav flex-column">

        <a class="nav-link {{ request()->routeIs('admin.dashboard.page') ? 'active' : '' }}" href="{{ route('admin.dashboard.page') }}">
            <i class="bi bi-house-door me-3"></i> Dashboard
        </a>

        <a class="nav-link {{ request()->routeIs('admin.storefront.page') ? 'active' : '' }}" href="{{ route('admin.storefront.page') }}">
            <i class="bi bi-shop me-3"></i> Storefront
        </a>

        <a class="nav-link {{ request()->routeIs('admin.inventory.page') ? 'active' : '' }}" href="{{ route('admin.inventory.page') }}">
            <i class="bi bi-box-seam me-3"></i> Inventory
        </a>

        <a class="nav-link {{ request()->routeIs('admin.orders.page') ? 'active' : '' }}" href="{{ route('admin.orders.page') }}">
            <i class="bi bi-receipt-cutoff me-3"></i> Orders
        </a>

        <a class="nav-link {{ request()->routeIs('admin.reports.page') ? 'active' : '' }}" href="{{ route('admin.reports.page') }}">
            <i class="bi bi-bar-chart me-3"></i> Reports
        </a>

    </nav>

    <div class="position-absolute bottom-0 start-0 p-4 w-100">
        <a class="nav-link small text-danger" href="/logout">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </div>
</aside>
