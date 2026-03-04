<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <style>
        .product-img-td {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .desc-truncate {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-available {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-low {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-not {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>

<body>

    @include('admin.navbar')


    <main class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Product Inventory</h2>
                    <p class="text-muted">Manage your stock levels and product details.</p>
                </div>
                <button class="btn btn-dark px-4 py-2 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#addProductModal">
                    <i class="bi bi-plus-circle me-2"></i> Add New Product
                </button>
            </div>

            <div class="card stat-card border-0 p-4 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr class="small text-muted">
                                <th>IMAGE</th>
                                <th>PRODUCT NAME</th>
                                <th>CATEGORY</th>
                                <th>DESCRIPTION</th>
                                <th>PRICE</th>
                                <th>STOCKS</th>
                                <th>SALES</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&q=80"
                                        class="product-img-td">
                                </td>
                                <td><span class="fw-bold">Coco Peat 5kg</span></td>
                                <td><span class="badge bg-secondary opacity-75">Soil & Fertilizer</span></td>
                                <td>
                                    <div class="desc-truncate text-muted small">High-quality organic coco peat for
                                        gardening...</div>
                                </td>
                                <td class="fw-bold">₱250.00</td>
                                <td><span class="fs-6">45</span></td>
                                <td class="text-success fw-bold">128</td>
                                <td>
                                    <span class="status-badge badge-available">Available</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735"
                                        class="product-img-td"></td>
                                <td><span class="fw-bold">Coir Hanging Pot</span></td>
                                <td><span class="badge bg-secondary opacity-75">Home Decor</span></td>
                                <td>
                                    <div class="desc-truncate text-muted small">Eco-friendly hanging pot made from
                                        coir...</div>
                                </td>
                                <td class="fw-bold">₱180.00</td>
                                <td><span class="fs-6">8</span></td>
                                <td class="text-success fw-bold">45</td>
                                <td>
                                    <span class="status-badge badge-low">Low Stocks</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6"
                                        class="product-img-td"></td>
                                <td><span class="fw-bold">Coir Mat (Large)</span></td>
                                <td><span class="badge bg-secondary opacity-75">Mats & Rugs</span></td>
                                <td>
                                    <div class="desc-truncate text-muted small">Durable door mat made of thick coir
                                        fiber...</div>
                                </td>
                                <td class="fw-bold">₱550.00</td>
                                <td><span class="fs-6">0</span></td>
                                <td class="text-success fw-bold">12</td>
                                <td>
                                    <span class="status-badge badge-not">Not Available</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
