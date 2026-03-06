<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
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

            <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-light text-black">
                            <h5 class="modal-title fw-bold">Add New Product</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.inventory.add.product') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body p-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Product Image</label>
                                        <div class="mb-2">
                                            <img id="imagePreview" src="#" alt="Preview"
                                                style="display:none; width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 1px solid #ddd;">
                                        </div>
                                        <input type="file" name="product_image" id="productImageInput"
                                            class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            placeholder="e.g. Coco Peat" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Category</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Description</label>
                                        <textarea name="product_description" class="form-control" rows="3" placeholder="Enter product details..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Price (₱)</label>
                                        <input type="number" name="product_price" class="form-control" step="0.01"
                                            placeholder="0.00" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Initial Stocks</label>
                                        <input type="number" name="product_stocks" class="form-control" placeholder="0"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark px-4">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/' . $product->product_image) }}"
                                            alt="{{ $product->product_name }}" class="product-img-td"
                                            onerror="this.src='https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&q=80'">
                                    </td>
                                    <td><span class="fw-bold">{{ $product->product_name }}</span></td>
                                    <td><span
                                            class="badge bg-secondary opacity-75">{{ $product->category_name }}</span>
                                    </td>
                                    <td>
                                        <div class="desc-truncate text-muted small">{{ $product->product_description }}
                                        </div>
                                    </td>
                                    <td class="fw-bold">₱{{ number_format($product->product_price, 2) }}</td>
                                    <td><span class="fs-6">{{ $product->product_stocks }}</span></td>
                                    <td class="text-success fw-bold">{{ $product->product_sales }}</td>
                                    <td>
                                        @php
                                            $statusClass = 'badge-available';
                                            if ($product->product_status == 'Low Stocks') {
                                                $statusClass = 'badge-low';
                                            }
                                            if (
                                                $product->product_status == 'Not Available' ||
                                                $product->product_stocks <= 0
                                            ) {
                                                $statusClass = 'badge-not';
                                            }
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $product->product_stocks <= 0 ? 'Out of Stock' : $product->product_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $product->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <form action="{{ route('admin.inventory.delete', $product->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this product permanently?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title fw-bold">Edit Product:
                                                        {{ $product->product_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.inventory.update', $product->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body p-4">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label class="form-label">Product Name</label>
                                                                <input type="text" name="product_name"
                                                                    class="form-control"
                                                                    value="{{ $product->product_name }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label
                                                                    class="form-label fw-semibold">Description</label>
                                                                <textarea name="product_description" class="form-control" rows="3" placeholder="Enter product details...">{{ $product->product_description }}</textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Category</label>
                                                                <select name="category_id" class="form-select"
                                                                    required>
                                                                    @foreach ($categories as $cat)
                                                                        <option value="{{ $cat->id }}"
                                                                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                                            {{ $cat->category_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" name="product_price"
                                                                    class="form-control" step="0.01"
                                                                    value="{{ $product->product_price }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Stocks</label>
                                                                <input type="number" name="product_stocks"
                                                                    class="form-control"
                                                                    value="{{ $product->product_stocks }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Update Image
                                                                    (Optional)</label>
                                                                <input type="file" name="product_image"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-dark">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        const imageInput = document.getElementById('productImageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                // When the file is read, set it as the image source
                reader.onload = function(e) {
                    imagePreview.setAttribute('src', e.target.result);
                    imagePreview.style.display = 'block'; // Show the image
                }

                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none'; // Hide if no file selected
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "pageLength": 10,
                "order": [
                    [1, "asc"]
                ], // Sort by Product Name
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 8]
                    } // Disable sorting on Image and Actions
                ]
            });
        });
    </script>
</body>

</html>
