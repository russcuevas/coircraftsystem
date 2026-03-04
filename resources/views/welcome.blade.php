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
                        <button class="btn btn-outline-eco btn-lg">
                            View All Products
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-images">
                        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6" class="img-1">
                        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735" class="img-2">
                        <img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7" class="img-3">
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

    <section class="products-section">
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-uppercase fw-bold small mb-1">Featured Products</p>
                <h2 class="display-5 fw-bold">Our Products</h2>
            </div>

            <div class="row g-4">

                <!-- Product 1 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6" class="card-img-top"
                            alt="">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">Coir Garden Mat</h6>
                            <p class="mb-2">₱450</p>
                            <button class="btn-add-cart">
                                <i class="bi bi-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735" class="card-img-top"
                            alt="">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">Coir Rope</h6>
                            <p class="mb-2">₱320</p>
                            <button class="btn-add-cart">
                                <i class="bi bi-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7" class="card-img-top"
                            alt="">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">Coir Fiber Roll</h6>
                            <p class="mb-2">₱780</p>
                            <button class="btn-add-cart">
                                <i class="bi bi-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef" class="card-img-top"
                            alt="">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">Coco Peat Block</h6>
                            <p class="mb-2">₱250</p>
                            <button class="btn-add-cart">
                                <i class="bi bi-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- VIEW ALL BUTTON -->
            <div class="text-center mt-5">
                <a href="#" class="btn btn-gold btn-lg px-5">
                    View All Products <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

        </div>
    </section>

    <section>
        <div class="container">
            <div class="text-center mb-5">
                <p class="text-uppercase fw-bold small mb-1" style="color: var(--accent-gold);">Browse by Use</p>
                <h2 class="display-5 fw-bold">Shop by Category</h2>
            </div>
            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg">
                    <div class="category-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1416870230247-d0e292295b4a?auto=format&fit=crop&q=80"
                            alt="Gardening">
                        <div class="category-overlay">
                            <span class="fw-bold">Gardening</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <div class="category-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80"
                            alt="Construction">
                        <div class="category-overlay">
                            <span class="fw-bold">Construction</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <div class="category-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1616489953149-804975560931?auto=format&fit=crop&q=80"
                            alt="Home Decor">
                        <div class="category-overlay">
                            <span class="fw-bold">Home Decor</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <div class="category-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80"
                            alt="Agriculture">
                        <div class="category-overlay">
                            <span class="fw-bold">Agriculture</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
