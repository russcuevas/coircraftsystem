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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <style>
        .badge-status { font-size: 0.75rem; padding: 5px 12px; border-radius: 50px; font-weight: 600; }
        .bg-pending { background-color: #fef3c7; color: #92400e; }
        .bg-delivery { background-color: #e0f2fe; color: #0369a1; }
        .bg-completed { background-color: #d1fae5; color: #065f46; }
        .text-paid { color: #198754; font-weight: bold; }
        .text-notpaid { color: #dc3545; font-weight: bold; }
        .view-details-link, .view-proof-link { font-size: 0.8rem; text-decoration: none; color: #d4bc8e; font-weight: 600; cursor:pointer; display:block; }
        .view-details-link:hover, .view-proof-link:hover { color: #1a3020; }
        .proof-img-container { max-height: 500px; overflow: hidden; border-radius: 8px; }
        .proof-img-container img { width: 100%; height: auto; object-fit: contain; }
    </style>
</head>
<body>
@include('navbar')

<main class="container my-5">
    <h2 class="fw-bold mb-3">My Transactions</h2>
    <p class="text-muted mb-4">Track your purchases and payment status.</p>

    @if($orders->isEmpty())
        <div class="alert alert-warning text-center">You have no orders yet.</div>
    @else
        <div class="card shadow-sm p-3">
            <div class="table-responsive">
                <table id="ordersTable" class="table align-middle table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Order #</th>
                            <th>Payment</th>
                            <th>Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @php
                                $modalOrderId = $order['order_number'];
                                $totalPrice = collect($order['products'])->sum(function($p){
                                    return $p['unit_price'] * $p['quantity'];
                                });
                            @endphp
                            <tr>
                                <td><span class="fw-bold text-primary">#{{ $order['order_number'] }}</span>
                                                                    <a class="view-details-link" data-bs-toggle="modal" data-bs-target="#orderDetailModal{{ $modalOrderId }}">
                                        <i class="bi bi-info-circle me-1"></i>View Details
                                    </a>
                                </td>
                                <td>
                                    <span class="small fw-bold">{{ strtoupper($order['payment_method']) }}</span><br>
                                    <span class="{{ $order['payment_status'] === 'paid' ? 'text-paid' : 'text-notpaid' }}">
                                        {{ strtoupper($order['payment_status']) }}
                                    </span>
                                    @if($order['payment_proof'])
                                        <a class="view-proof-link" data-bs-toggle="modal" data-bs-target="#proofModal{{ $modalOrderId }}">
                                            <i class="bi bi-image me-1"></i>View Proof
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><i class="bi bi-truck me-1"></i> {{ $order['delivery_method'] }}</span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = $order['status'] === 'Pending' ? 'bg-pending' : ($order['status'] === 'for delivery' ? 'bg-delivery' : 'bg-completed');
                                    @endphp
                                    <span class="badge-status {{ $statusClass }}">{{ $order['status'] }}</span>
                                </td>
                            </tr>

                            <!-- Order Details Modal -->
                            <div class="modal fade" id="orderDetailModal{{ $modalOrderId }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title fw-bold">Order Breakdown</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                                <span class="text-muted">Order Number:</span>
                                                <span class="fw-bold">{{ $order['order_number'] }}</span>
                                            </div>
                                            <div class="mb-4">
                                                <h6 class="fw-bold text-success mb-3">Items Purchased</h6>
                                                @foreach($order['products'] as $p)
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div>
                                                            <p class="mb-0 fw-bold">{{ $p['product_name'] }}</p>
                                                            <small class="text-muted">Unit Price: ₱{{ number_format($p['unit_price'],2) }}</small>
                                                        </div>
                                                        <span class="badge bg-secondary">x {{ $p['quantity'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="card bg-light border-0 p-3">
                                                <div class="d-flex justify-content-between mb-1"><span>Subtotal</span><span>₱{{ number_format($totalPrice,2) }}</span></div>
                                                <div class="d-flex justify-content-between mb-1"><span>Shipping Fee</span><span>₱0.00</span></div>
                                                <hr>
                                                <div class="d-flex justify-content-between fw-bold fs-5"><span>Total Amount</span><span class="text-success">₱{{ number_format($totalPrice,2) }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Proof Modal -->
                            @if($order['payment_proof'])
                                <div class="modal fade" id="proofModal{{ $modalOrderId }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title fw-bold"><i class="bi bi-shield-check me-2"></i>Payment Proof</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-0 text-center bg-light">
                                                <div class="proof-img-container p-3">
                                                    <img src="{{ asset('payment_proofs/'.$order['payment_proof']) }}" alt="Proof" class="shadow-sm">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 d-flex justify-content-between">
                                                <div class="text-start">
                                                    <small class="text-muted d-block">Transaction Date:</small>
                                                    <span class="small fw-bold">{{ $order['created_at'] }}</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</main>
    @include('footer')
<!-- jQuery first -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
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
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "order": [[0, "desc"]], // order by first column (Order #) descending
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50],
        });
    });
</script>
</body>
</html>