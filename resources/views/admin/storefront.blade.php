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

            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <div class="card stat-card p-4 h-100 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 section-header">New Arrivals</h5>
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-plus-lg"></i> Add</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="small text-muted">
                                        <th>PRODUCT</th>
                                        <th>PRICE</th>
                                        <th>STATUS</th>
                                        <th>REMOVE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6"
                                                    class="product-thumbnail">
                                                <span class="fw-bold">Coir Garden Mat</span>
                                            </div>
                                        </td>
                                        <td>₱450</td>
                                        <td><span class="badge bg-info featured-badge">New</span></td>
                                        <td><button class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card stat-card p-4 h-100 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 section-header">Best Sellers</h5>
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-plus-lg"></i> Add</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="small text-muted">
                                        <th>PRODUCT</th>
                                        <th>SALES</th>
                                        <th>STATUS</th>
                                        <th>REMOVE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef"
                                                    class="product-thumbnail">
                                                <span class="fw-bold">Coco Peat Block</span>
                                            </div>
                                        </td>
                                        <td>420 Sold</td>
                                        <td><span class="badge bg-warning text-dark featured-badge">Best Seller</span>
                                        </td>
                                        <td><button class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card stat-card p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 section-header">Trending Products</h5>
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-plus-lg"></i> Manage
                                Trending List</button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="p-3 border rounded-3 bg-white text-center">
                                    <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735"
                                        class="img-fluid rounded mb-2" style="height: 100px; object-fit: cover;">
                                    <h6 class="mb-0 fw-bold">Coir Rope</h6>
                                    <small class="text-primary">+15% this week</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 border rounded-3 bg-white text-center">
                                    <img src="https://images.unsplash.com/photo-1492724441997-5dc865305da7"
                                        class="img-fluid rounded mb-2" style="height: 100px; object-fit: cover;">
                                    <h6 class="mb-0 fw-bold">Coir Fiber Roll</h6>
                                    <small class="text-primary">+8% this week</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
