<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storefront Management | CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .product-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }

        .featured-badge {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-header {
            border-left: 4px solid var(--accent-gold);
            padding-left: 15px;
        }

        .product-select-card {
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-select-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .product-checkbox {
            width: 1.2rem;
            height: 1.2rem;
            z-index: 10;
        }

        .product-select-card img {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .product-checkbox {
            width: 1.2rem;
            height: 1.2rem;
            z-index: 10;
        }
    </style>
</head>

<body>

    @include('admin.navbar')


    <main class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold">Storefront Management</h2>
                    <p class="text-muted">Customize how customers see your products on the home page.</p>
                </div>
            </div>

            <div class="mb-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-lg"></i> Add Product
                </button>
            </div>

            <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('admin.storefront.update_features') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Products to Storefront</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Feature Selection -->
                                <div class="mb-4">
                                    <label for="feature" class="form-label fw-bold">Select Feature</label>
                                    <select name="feature" id="feature" class="form-select" required>
                                        <option value="" selected disabled>Choose feature</option>
                                        <option value="new">New Arrival</option>
                                        <option value="trending">Trending</option>
                                        <option value="best seller">Best Seller</option>
                                    </select>
                                </div>

                                <!-- Products Selection -->
                                <label class="form-label fw-bold mb-2">Select Products</label>
                                <div class="row g-3">
                                    @foreach ($availableProducts as $product)
                                        <div class="col-md-4">
                                            <div class="card product-select-card h-100 border rounded-3 position-relative p-2"
                                                data-checkbox-id="product_{{ $product->id }}">
                                                <!-- Checkbox overlay (hidden visually if you want) -->
                                                <input type="checkbox"
                                                    class="form-check-input product-checkbox position-absolute top-0 end-0 m-2"
                                                    name="product_ids[]" value="{{ $product->id }}"
                                                    id="product_{{ $product->id }}">
                                                <!-- Product Image -->
                                                <img src="{{ asset('images/' . $product->product_image) }}"
                                                    class="card-img-top rounded mb-2"
                                                    style="height: 120px; object-fit: cover;">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title mb-0">{{ $product->product_name }}</h6>
                                                    <small
                                                        class="text-muted">₱{{ number_format($product->product_price, 2) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <div class="card stat-card p-4 h-100 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 section-header">New Arrivals</h5>
                        </div>
                        <div class="table-responsive">
                            <table id="newArrivalsTable" class="table align-middle">
                                <thead>
                                    <tr class="small text-muted">
                                        <th>PRODUCT</th>
                                        <th>PRICE</th>
                                        <th>STATUS</th>
                                        <th>REMOVE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newArrivals as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ asset('images/' . $product->product_image) }}"
                                                        class="product-thumbnail">
                                                    <span class="fw-bold">{{ $product->product_name }}</span>
                                                </div>
                                            </td>
                                            <td>₱{{ number_format($product->product_price, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-info featured-badge">{{ ucfirst($product->product_feature) }}</span>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.storefront.delete_product', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to remove this product from the storefront?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm text-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card stat-card p-4 h-100 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 section-header">Best Sellers</h5>
                        </div>
                        <div class="table-responsive">
                            <table id="bestSellersTable" class="table align-middle">
                                <thead>
                                    <tr class="small text-muted">
                                        <th>PRODUCT</th>
                                        <th>SALES</th>
                                        <th>STATUS</th>
                                        <th>REMOVE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bestSellers as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ asset('images/' . $product->product_image) }}"
                                                        class="product-thumbnail">
                                                    <span class="fw-bold">{{ $product->product_name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $product->product_sales }} Sold</td>
                                            <td>
                                                <span
                                                    class="badge bg-warning text-dark featured-badge">{{ ucfirst($product->product_feature) }}</span>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.storefront.delete_product', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to remove this product from the storefront?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm text-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card stat-card p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 section-header">Trending Products</h5>
                        </div>
                        <div class="row g-3">
                            @foreach ($trendingProducts as $product)
                                <div class="col-md-3">
                                    <div class="p-3 border rounded-3 bg-white text-center position-relative">
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.storefront.delete_product', $product->id) }}"
                                            method="POST" class="position-absolute top-0 end-0 m-2"
                                            onsubmit="return confirm('Are you sure you want to remove this product from Trending?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                        <!-- Product Image -->
                                        <img src="{{ asset('images/' . $product->product_image) }}"
                                            class="img-fluid rounded mb-2" style="height: 100px; object-fit: cover;">
                                        <h6 class="mb-0 fw-bold">{{ $product->product_name }}</h6>
                                        <small class="text-primary">+{{ $product->product_sales }} Sold this
                                            week</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        $(document).ready(function() {
            // Shared configuration
            const tableConfig = {
                "pageLength": 5,
                "lengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search products..."
                },
                "columnDefs": [{
                        "orderable": false,
                        "targets": 3
                    } // Disables sorting on the "REMOVE" column
                ]
            };

            $('#newArrivalsTable').DataTable(tableConfig);
            $('#bestSellersTable').DataTable(tableConfig);
        });
    </script>
    <script>
        // 1. Initialize Notyf with a clean, modern look
        const notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top'
            },
            dismissible: true,
            types: [{
                    type: 'success',
                    background: '#198754', // Bootstrap Success Green
                    icon: {
                        className: 'bi bi-check-circle-fill',
                        tagName: 'i',
                        color: 'white'
                    }
                },
                {
                    type: 'error',
                    background: '#dc3545', // Bootstrap Danger Red
                    icon: {
                        className: 'bi bi-exclamation-triangle-fill',
                        tagName: 'i',
                        color: 'white'
                    }
                }
            ]
        });

        // 2. Fire alerts based on Laravel Session data
        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.product-select-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.tagName !== 'INPUT') {
                        const checkboxId = card.getAttribute('data-checkbox-id');
                        const checkbox = document.getElementById(checkboxId);
                        checkbox.checked = !checkbox.checked;
                    }
                });
            });
        });
    </script>
</body>

</html>
