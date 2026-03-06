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

    <section class="shop-section">
        <div class="container">
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-lg-3">

                    <h4 class="mb-3">Search</h4>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="">
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <h5 class="fw-bold">Categories</h5>
                    <ul class="shop-category">
                        <li>Gardening</li>
                        <li>Construction</li>
                        <li>Home Decor</li>
                        <li>Agriculture</li>
                    </ul>


                </div>


                <!-- RIGHT PRODUCTS -->
                <div class="col-lg-9">

                    <div class="d-flex justify-content-between mb-4">
                        <h4>Our Products</h4>

                    </div>

                    <div class="row g-4">

                        <!-- Product -->
                        <div class="col-md-4">
                            <div class="card product-card-shop">
                                <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6"
                                    class="card-img-top">
                                <div class="card-body">
                                    <h6 class="fw-bold">Coir Garden Mat</h6>
                                    <p class="text-muted">Gardening</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">₱450</span>

                                        <button class="btn-add-cart-shop">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
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
