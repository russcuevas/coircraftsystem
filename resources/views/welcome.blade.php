<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .category-img-wrapper {
            height: 250px;
            /* Fixed height for all boxes */
            width: 100%;
            overflow: hidden;
            position: relative;
            border-radius: 12px;
        }

        .category-img-wrapper img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            /* This crops the image to fill the space without stretching */
            transition: transform 0.5s ease;
        }

        .category-img-wrapper:hover img {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    @include('navbar')
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge-eco mb-4 d-inline-block">
                        <i class="bi bi-globe-asia-australia me-2"></i> Sustainably Sourced from the Philippines
                    </span>

                    <h1 class="display-2 fw-bold mb-4">
                        Nature's Finest <br>
                        <span style="color: var(--accent-gold);">Coir Products</span>
                    </h1>

                    <p class="fs-5 mb-5 opacity-75">
                        Discover our collection of eco-friendly coconut coir products — from garden
                        mats to construction materials. Built sustainably, built to last.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <button class="btn btn-gold btn-lg">
                            Shop Now <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-images">
                        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6" class="img-1">
                        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735" class="img-2">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80"
                            class="img-3">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef" class="img-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100 d-flex align-items-center">
                        <div class="icon-square me-3"><i class="bi bi-recycle"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">100% Eco-Friendly</h6>
                            <p class="small text-muted mb-0">Biodegradable and sustainable fiber.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100 d-flex align-items-center">
                        <div class="icon-square me-3"><i class="bi bi-truck"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Nationwide Delivery</h6>
                            <p class="small text-muted mb-0">Shipping across the Philippines.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100 d-flex align-items-center">
                        <div class="icon-square me-3"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Quality Guaranteed</h6>
                            <p class="small text-muted mb-0">Quality-tested for satisfaction.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="products-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-uppercase fw-bold small mb-1" style="color: var(--accent-gold);">Curated Collections</p>
                <h2 class="display-5 fw-bold">Featured Products</h2>
            </div>

            <ul class="nav nav-pills justify-content-center mb-5" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active mx-2 px-4" id="trending-tab" data-bs-toggle="pill"
                        data-bs-target="#trending" type="button">Trending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link mx-2 px-4" id="new-tab" data-bs-toggle="pill" data-bs-target="#new"
                        type="button">New Arrivals</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link mx-2 px-4" id="best-tab" data-bs-toggle="pill" data-bs-target="#best"
                        type="button">Best Sellers</button>
                </li>
            </ul>

            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade show active" id="trending" role="tabpanel">
                    <div class="row g-4">
                        @forelse($trendingProducts as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <span
                                            class="badge bg-danger position-absolute top-0 start-0 m-3">Trending</span>
                                        <img src="{{ asset('images/' . $product->product_image) }}" class="card-img-top"
                                            alt="{{ $product->product_name }}">
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="fw-bold">{{ $product->product_name }}</h6>
                                        <p class="text-gold mb-2">₱{{ number_format($product->product_price, 2) }}</p>
                                        <button class="btn btn-outline-dark btn-sm rounded-pill w-100">
                                            <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No trending products at the moment.</p>
                        @endforelse
                    </div>
                </div>

                <div class="tab-pane fade" id="new" role="tabpanel">
                    <div class="row g-4">
                        @forelse($newArrivals as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <span class="badge bg-info position-absolute top-0 start-0 m-3">New</span>
                                        <img src="{{ asset('images/' . $product->product_image) }}"
                                            class="card-img-top" alt="{{ $product->product_name }}">
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="fw-bold">{{ $product->product_name }}</h6>
                                        <p class="text-gold mb-2">₱{{ number_format($product->product_price, 2) }}</p>
                                        <button class="btn btn-outline-dark btn-sm rounded-pill w-100">
                                            <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Check back soon for new arrivals!</p>
                        @endforelse
                    </div>
                </div>

                <div class="tab-pane fade" id="best" role="tabpanel">
                    <div class="row g-4">
                        @forelse($bestSellers as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <span
                                            class="badge bg-warning text-dark position-absolute top-0 start-0 m-3">Best
                                            Seller</span>
                                        <img src="{{ asset('images/' . $product->product_image) }}"
                                            class="card-img-top" alt="{{ $product->product_name }}">
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="fw-bold">{{ $product->product_name }}</h6>
                                        <p class="text-gold mb-2">₱{{ number_format($product->product_price, 2) }}</p>
                                        <button class="btn btn-outline-dark btn-sm rounded-pill w-100">
                                            <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Our best sellers are resting. Check back later!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-gold btn-lg px-5">
                View All Products <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-uppercase fw-bold small mb-1" style="color: var(--accent-gold);">Browse by Use</p>
                <h2 class="display-5 fw-bold">Shop by Category</h2>
            </div>

            <div class="row g-3 justify-content-center">
                @php
                    // Static image mapping based on category names
                    $categoryImages = [
                        'Gardening' =>
                            'https://plus.unsplash.com/premium_photo-1678457828893-375d0572a589?q=80&w=688&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'Construction' =>
                            'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80',
                        'Home Decor' =>
                            'https://media.istockphoto.com/id/491365816/photo/welcome-carpet.jpg?s=1024x1024&w=is&k=20&c=5LfN4xwhBM2Ax_hQtiGtvf82IEjnbuU7QX_IeM1wwWI=',
                        'Agriculture' =>
                            'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80',
                    ];
                    // Default image if category name doesn't match
$defaultImage =
    'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&q=80';
                @endphp

                @foreach ($categories as $cat)
                    <div class="col-6 col-md-4 col-lg">
                        <a href="#{{ Str::slug($cat->category_name) }}" class="text-decoration-none">
                            <div class="category-img-wrapper position-relative overflow-hidden rounded-3 shadow-sm">
                                <img src="{{ $categoryImages[$cat->category_name] ?? $defaultImage }}"
                                    alt="{{ $cat->category_name }}" class="img-fluid w-100"
                                    style="height: 250px; object-fit: cover; transition: transform 0.5s;">

                                <div class="category-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                    style="background: rgba(0,0,0,0.3); transition: background 0.3s;">
                                    <span class="fw-bold text-white fs-5">{{ $cat->category_name }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
