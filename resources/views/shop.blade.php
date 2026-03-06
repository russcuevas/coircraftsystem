<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .shop-category a {
            text-decoration: none;
        }

        .shop-category a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>

    @include('navbar')

    <input type="hidden" id="currentCategory" value="{{ request('category') }}">

    <section class="shop-section">
        <div class="container">
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-lg-3">

                    <h4 class="mb-3">Search</h4>

                    <div class="input-group mb-4">

                        <input type="text" id="searchProduct" class="form-control" placeholder="Search product">

                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>

                    </div>


                    <h5 class="fw-bold">Categories</h5>

                    <ul class="shop-category">

                        <li>
                            <a class="{{ request('category') ? '' : 'fw-bold text-success' }}"
                                href="{{ url('/shop') }}">
                                All
                            </a>
                        </li>

                        @foreach ($categories as $category)
                            <li>
                                <a class="{{ request('category') == $category->id ? 'fw-bold text-success' : '' }}"
                                    href="{{ url('/shop?category=' . $category->id) }}">

                                    {{ $category->category_name }}

                                </a>
                            </li>
                        @endforeach

                    </ul>

                </div>


                <!-- RIGHT PRODUCTS -->
                <div class="col-lg-9">

                    <div class="d-flex justify-content-between mb-4">
                        <h4>Our Products</h4>
                    </div>

                    <div class="row g-4" id="productList">

                        @if ($products->isEmpty())

                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    No products found
                                </div>
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="col-md-4">

                                    <div class="card product-card-shop h-100">

                                        <img src="{{ asset('images/' . $product->product_image) }}" class="card-img-top"
                                            style="height:200px; object-fit:cover;">

                                        <div class="card-body">

                                            <h6 class="fw-bold">
                                                {{ $product->product_name }}
                                            </h6>

                                            <p class="text-muted">
                                                {{ $product->category_name }}
                                            </p>

                                            <div class="d-flex justify-content-between align-items-center">

                                                <span class="fw-bold">
                                                    ₱{{ number_format($product->product_price, 2) }}
                                                </span>

                                                @auth
                                                    <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                                        class="d-flex align-items-center gap-1">
                                                        @csrf
                                                        <input type="number" name="quantity" value="1" min="1"
                                                            class="form-control form-control-sm" style="width: 60px;">
                                                        <button class="btn btn-outline-dark btn-sm" type="submit">
                                                            <i class="bi bi-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-outline-secondary btn-sm"
                                                        onclick="alert('Please login first')">
                                                        <i class="bi bi-cart-plus"></i>
                                                    </button>
                                                @endauth

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        @endif

                    </div>

                </div>

            </div>
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        const notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top'
            },
            dismissible: true,
            types: [{
                    type: 'success',
                    background: '#198754',
                    icon: {
                        className: 'bi bi-check-circle-fill',
                        tagName: 'i',
                        color: 'white'
                    }
                },
                {
                    type: 'error',
                    background: '#dc3545',
                    icon: {
                        className: 'bi bi-exclamation-triangle-fill',
                        tagName: 'i',
                        color: 'white'
                    }
                }
            ]
        });

        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    </script>
    <script>
        const userIsAuth = @json(Auth::check());
        const csrfToken = '{{ csrf_token() }}';
    </script>
    <script>
        document.getElementById("searchProduct").addEventListener("keyup", function() {

            let search = this.value;
            let category = document.getElementById("currentCategory").value;

            fetch(`/shop-search?search=${search}&category=${category}`)
                .then(response => response.json())
                .then(data => {

                    let html = "";

                    if (data.length === 0) {

                        html = `
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No products found
                        </div>
                    </div>
                `;

                    } else {

                        data.forEach(product => {

                            html += `
                    <div class="col-md-4">

                        <div class="card product-card-shop h-100">

                            <img src="/images/${product.product_image}" 
                                class="card-img-top"
                                style="height:200px; object-fit:cover;">

                            <div class="card-body">

                                <h6 class="fw-bold">${product.product_name}</h6>
                                <p class="text-muted">${product.category_name}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">₱${parseFloat(product.product_price).toFixed(2)}</span>

                                    ${userIsAuth ? `
                                            <form action="/cart/add/${product.id}" method="POST" class="d-flex align-items-center gap-1">
                                                <input type="hidden" name="_token" value="${csrfToken}">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width:60px;">
                                                <button class="btn btn-outline-dark btn-sm" type="submit"><i class="bi bi-cart-plus"></i></button>
                                            </form>
                                        ` : `
                                            <button class="btn btn-outline-secondary btn-sm" onclick="alert('Please login first')">
                                                <i class="bi bi-cart-plus"></i>
                                            </button>
                                        `}

                                </div>

                            </div>

                        </div>

                    </div>
                    `;

                        });

                    }

                    document.getElementById("productList").innerHTML = html;

                });

        });
    </script>

</body>

</html>
