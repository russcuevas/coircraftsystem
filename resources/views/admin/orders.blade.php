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
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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
                                <th>Payment</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $total = 0;
                                    foreach ($order->products as $product) {
                                        $total += $product['unit_price'] * $product['quantity'];
                                    }
                                @endphp
                                <tr>
                                    <td><span class="fw-bold text-primary">{{ $order->order_number }}</span>
                                        <a class="view-details-link" data-bs-toggle="modal"
                                            data-bs-target="#orderDetailModal{{ $order->order_id }}">
                                            <i class="bi bi-info-circle me-1"></i>View Details
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">{{ $order->customer_name }}</span>
                                            <small class="text-muted">User ID: {{ $order->user_id }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span
                                                class="small fw-bold text-uppercase">{{ $order->payment_method }}</span>

                                            @if ($order->payment_status === 'paid')
                                                <span class="text-paid small mb-1"><i
                                                        class="bi bi-check-circle-fill me-1"></i>PAID</span>
                                            @elseif ($order->payment_status === 'not paid')
                                                <span class="text-notpaid small mb-1"><i
                                                        class="bi bi-x-circle-fill me-1"></i>NOT PAID</span>
                                            @endif

                                            <form action="{{ route('admin.orders.togglePayment', $order->order_id) }}"
                                                method="POST" class="mt-1">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success">Toggle
                                                    Payment</button>
                                            </form>

                                            @if ($order->payment_method === 'GCash' && $order->payment_proof)
                                                <a class="view-proof-link mt-1" data-bs-toggle="modal"
                                                    data-bs-target="#proofModal{{ $order->order_id }}">
                                                    <i class="bi bi-shield-check me-1"></i>View Proof
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><i
                                                class="bi bi-truck me-1"></i>{{ $order->delivery_method }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge-status 
                                {{ $order->status == 'Pending'
                                    ? 'bg-pending'
                                    : ($order->status == 'For Delivery'
                                        ? 'bg-delivery'
                                        : ($order->status == 'Completed'
                                            ? 'bg-completed'
                                            : ($order->status == 'Rejected'
                                                ? 'bg-danger text-white'
                                                : ''))) }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}"
                                            method="POST">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm mb-1">
                                                <option value="Pending"
                                                    {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="For Delivery"
                                                    {{ $order->status == 'For Delivery' ? 'selected' : '' }}>For
                                                    Delivery
                                                </option>
                                                <option value="Completed"
                                                    {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="Rejected"
                                                    {{ $order->status == 'Rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                        </form>
                                    </td>
                                </tr>

                                @if ($order->payment_method === 'GCash' && $order->payment_proof)
                                    <div class="modal fade" id="proofModal{{ $order->order_id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title fw-bold"><i
                                                            class="bi bi-shield-check me-2"></i>Payment Proof</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-0 text-center bg-light">
                                                    <div class="proof-img-container p-3">
                                                        <img src="{{ asset('payment_proofs/' . $order->payment_proof) }}"
                                                            alt="Proof" class="shadow-sm">
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 d-flex justify-content-between">
                                                    <div class="text-start">
                                                        <small class="text-muted d-block">Transaction Date:</small>
                                                        <span
                                                            class="small fw-bold">{{ \Carbon\Carbon::parse($order->updated_at)->format('F d, Y - h:i A') }}</span>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary px-4"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <!-- Order Details Modal -->
                                <div class="modal fade" id="orderDetailModal{{ $order->order_id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title fw-bold">Order Breakdown</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                                    <span class="text-muted">Order Number:</span>
                                                    <span class="fw-bold">{{ $order->order_number }}</span>
                                                </div>
                                                <div class="mb-4">
                                                    <h6 class="fw-bold text-success mb-3">Items Purchased</h6>
                                                    @foreach ($order->products as $product)
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <div>
                                                                <p class="mb-0 fw-bold">{{ $product['product_name'] }}
                                                                </p>
                                                                <small class="text-muted">Unit Price:
                                                                    ₱{{ number_format($product['unit_price'], 2) }}</small>
                                                            </div>
                                                            <span class="badge bg-secondary">x
                                                                {{ $product['quantity'] }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="card bg-light border-0 p-3">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <span>Subtotal</span><span>₱{{ number_format($total, 2) }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-1"><span>Shipping
                                                            Fee</span><span>₱0.00</span></div>
                                                    <hr>
                                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                                        <span>Total Amount</span><span
                                                            class="text-success">₱{{ number_format($total, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $(document).ready(function() {
            $('.table').DataTable({
                "pageLength": 10,
            });
        });
    </script>
    <script>
        const notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top'
            },
            dismissible: true
        });

        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    </script>
</body>

</html>
