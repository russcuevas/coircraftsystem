<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management | CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <style>
        .badge-status {
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 50px;
            font-weight: 600;
        }

        .bg-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .bg-delivery {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .bg-completed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .text-paid {
            color: #198754;
            font-weight: bold;
        }

        .text-notpaid {
            color: #dc3545;
            font-weight: bold;
        }

        .view-details-link,
        .view-proof-link {
            font-size: 0.8rem;
            text-decoration: none;
            color: #d4bc8e;
            font-weight: 600;
            cursor: pointer;
            display: block;
        }

        .view-details-link:hover,
        .view-proof-link:hover {
            color: #1a3020;
        }

        /* Image Proof Styling */
        .proof-img-container {
            max-height: 500px;
            overflow: hidden;
            border-radius: 8px;
        }

        .proof-img-container img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
    </style>
</head>

<body>

    @include('admin.navbar')

    <main class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Order Management</h2>
                    <p class="text-muted">Process and track customer purchases.</p>
                </div>
            </div>

            <div class="card stat-card border-0 p-4 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Product Details</th>
                                <th>Payment</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="fw-bold text-primary">#ORD-2026-001</span></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">Russel Vincent</span>
                                        <small class="text-muted">User ID: 104</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold fs-5 text-dark">₱1,100.00</span>
                                        <a class="view-details-link" data-bs-toggle="modal"
                                            data-bs-target="#orderDetailModal001">
                                            <i class="bi bi-info-circle me-1"></i>View Details
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="small fw-bold text-uppercase">GCASH</span>
                                        <span class="text-paid small mb-1"><i class="bi bi-check-circle-fill me-1"></i>
                                            PAID</span>
                                        <a class="view-proof-link" data-bs-toggle="modal"
                                            data-bs-target="#proofModal001">
                                            <i class="bi bi-image me-1"></i>View Proof
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><i class="bi bi-truck me-1"></i>
                                        Delivery</span>
                                </td>
                                <td><span class="badge-status bg-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border dropdown-toggle"
                                        data-bs-toggle="dropdown">Update</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Mark for Delivery</a></li>
                                        <li><a class="dropdown-item" href="#">Mark as Completed</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="orderDetailModal001" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold">Order Breakdown</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                        <span class="text-muted">Order Number:</span>
                        <span class="fw-bold">#ORD-2026-001</span>
                    </div>
                    <div class="mb-4">
                        <h6 class="fw-bold text-success mb-3">Items Purchased</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 fw-bold">Coir Mat (Large)</p>
                                <small class="text-muted">Unit Price: ₱550.00</small>
                            </div>
                            <span class="badge bg-secondary">x 2</span>
                        </div>
                    </div>
                    <div class="card bg-light border-0 p-3">
                        <div class="d-flex justify-content-between mb-1"><span>Subtotal</span><span>₱1,100.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1"><span>Shipping Fee</span><span>₱0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5"><span>Total Amount</span><span
                                class="text-success">₱1,100.00</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="proofModal001" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-shield-check me-2"></i>Payment Proof</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 text-center bg-light">
                    <div class="proof-img-container p-3">
                        <img src="https://media.istockphoto.com/id/1283637148/photo/mobile-payment-confirmation-concept.jpg?s=612x612&w=0&k=20&c=6n6Xz-tE4v3jV_O2wK_1YmE-4S2mX-vJ6pYJ9_L9-8w="
                            alt="GCash Receipt" class="shadow-sm">
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-between">
                    <div class="text-start">
                        <small class="text-muted d-block">Transaction Date:</small>
                        <span class="small fw-bold">March 04, 2026 - 10:30 AM</span>
                    </div>
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
