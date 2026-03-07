    <div class="py-2 text-center text-white small" style="background-color: #0e1a11;">
        🌿 Free delivery on orders over ₱1,500 • Eco-friendly & sustainable
    </div>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <i class="bi bi-leaf-fill text-success me-2"></i>
                <div>
                    <span class="fw-bold d-flex align-items-center lh-1">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="me-2" style="height: 30px;">
                        CoirCraft PH
                    </span> <small class="text-muted small" style="font-size: 0.7rem;">ECO PRODUCTS</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home.page') ? 'active' : '' }}"
                            href="{{ route('home.page') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('shop.page') ? 'active' : '' }}"
                            href="{{ route('shop.page') }}">
                            Shop
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">

                    <a href="/cart" class="text-dark position-relative">
                        <i class="bi bi-cart3 fs-5"></i>
                        <span id="cart-count-badge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </a>

                    <script>
                        function updateCartCount() {
                            fetch('/cart-count')
                                .then(res => res.json())
                                .then(data => {
                                    document.getElementById('cart-count-badge').textContent = data.cartCount;
                                });
                        }

                        updateCartCount();
                    </script>

                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="text-dark dropdown-toggle" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">

                            @auth
                                <li>
                                    <a class="dropdown-item" href="/profile">
                                        <i class="bi bi-person me-2"></i> My Profile
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/transactions">
                                        <i class="bi bi-receipt me-2"></i> My Transaction
                                    </a>
                                </li>

                                <li>
                                    <form action="{{ route('auth.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endauth


                            @guest
                                <li>
                                    <a class="dropdown-item" href="/login">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/register">
                                        <i class="bi bi-person-plus me-2"></i> Register
                                    </a>
                                </li>
                            @endguest

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </nav>
