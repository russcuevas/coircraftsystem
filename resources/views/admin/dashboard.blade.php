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
    <style>
        .card-link {
            text-decoration: none;
        }

        .card-link .stat-card {
            transition: background-color 0.3s, transform 0.2s, color 0.3s;
            cursor: pointer;
        }

        .card-link .stat-card:hover {
            background-color: #1a3020;
            color: #fff;
            transform: translateY(-5px);
        }

        .card-link .stat-card:hover .icon-box {
            background-color: #2a482f;
        }

        .card-link .stat-card:hover small.text-muted {
            color: #f3f3f3 !important;
        }
    </style>
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
            <div class="mb-4">
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Welcome back! Here's your store overview.</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card p-4">
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted">Today's Sales</small>
                                <h3 class="fw-bold mt-1">₱{{ number_format($todaysSales, 2) }}</h3>
                            </div>
                            <div class="icon-box bg-success"><i class="bi bi-currency-dollar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card p-4">
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted">Monthly Sales</small>
                                <h3 class="fw-bold mt-1">₱{{ number_format($monthlySales, 2) }}</h3>
                            </div>
                            <div class="icon-box bg-primary"><i class="bi bi-graph-up"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card p-4">
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted">Total Orders</small>
                                <h3 class="fw-bold mt-1">{{ $totalOrders }}</h3>
                            </div>
                            <div class="icon-box" style="background-color: #a855f7;"><i class="bi bi-bag-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card p-4">
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted">Pending Orders</small>
                                <h3 class="fw-bold mt-1">{{ $pendingOrders }}</h3>
                            </div>
                            <div class="icon-box bg-warning"><i class="bi bi-clock"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <a href="{{ route('admin.inventory.page') }}" class="card-link">
                        <div class="card stat-card p-3 d-flex flex-row align-items-center">
                            <div class="icon-box bg-dark me-3"><i class="bi bi-box"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Manage Inventory</h6>
                                <small class="text-muted">Add/Edit products</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.reports.page') }}" class="card-link">
                        <div class="card stat-card p-3 d-flex flex-row align-items-center">
                            <div class="icon-box bg-dark me-3"><i class="bi bi-journal-text"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">View Reports</h6>
                                <small class="text-muted">Sales analytics</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.storefront.page') }}" class="card-link">
                        <div class="card stat-card p-3 d-flex flex-row align-items-center">
                            <div class="icon-box bg-dark me-3"><i class="bi bi-pencil-square"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Edit Storefront</h6>
                                <small class="text-muted">Update shop page</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="card stat-card p-4 shadow-sm">
                <h5 class="fw-bold mb-4">Recent Orders</h5>

                <div class="table-responsive">
                                    <a href="/admin/orders" class="btn btn-sm btn-outline-dark">
                    View All Orders
                </a>
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr class="small text-muted">
                                <th>ORDER ID</th>
                                <th>CUSTOMER</th>
                                <th>DATE</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td class="fw-bold">{{ $order->customer_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                    <td class="fw-bold">₱{{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($order->status) {
                                                'Pending' => 'bg-pending',
                                                'For Delivery' => 'bg-delivery',
                                                'Completed' => 'bg-completed',
                                                'Rejected' => 'bg-danger text-white',
                                                default => '',
                                            };
                                        @endphp
                                        <span class="badge-status {{ $statusClass }}">{{ $order->status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

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
</body>

</html>
