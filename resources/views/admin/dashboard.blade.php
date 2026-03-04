<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
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
                                <h3 class="fw-bold mt-1">₱1248.00</h3>
                            </div>
                            <div class="icon-box bg-success"><i class="bi bi-currency-dollar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card p-4">
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted">Monthly Sales</small>
                                <h3 class="fw-bold mt-1">₱1248.00</h3>
                            </div>
                            <div class="icon-box bg-primary"><i class="bi bi-graph-up"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card stat-card p-4">
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted">Total Orders</small>
                                <h3 class="fw-bold mt-1">1</h3>
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
                                <h3 class="fw-bold mt-1">1</h3>
                            </div>
                            <div class="icon-box bg-warning"><i class="bi bi-clock"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card stat-card p-3 d-flex flex-row align-items-center">
                        <div class="icon-box bg-dark me-3"><i class="bi bi-box"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Manage Inventory</h6><small class="text-muted">Add/Edit
                                products</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-3 d-flex flex-row align-items-center">
                        <div class="icon-box bg-dark me-3"><i class="bi bi-journal-text"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">View Reports</h6><small class="text-muted">Sales
                                analytics</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-3 d-flex flex-row align-items-center">
                        <div class="icon-box bg-dark me-3"><i class="bi bi-pencil-square"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Edit Storefront</h6><small class="text-muted">Update shop
                                page</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card stat-card p-4 shadow-sm">
                <h5 class="fw-bold mb-4">Recent Orders</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr class="small text-muted">
                                <th>ORDER ID</th>
                                <th>CUSTOMER</th>
                                <th>DATE</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#03A4B207</td>
                                <td class="fw-bold">Cuevas Russel Vincent</td>
                                <td>Mar 3, 2026</td>
                                <td class="fw-bold">₱1248.00</td>
                                <td><span class="badge-pending">pending</span></td>
                                <td><select class="form-select form-select-sm w-auto">
                                        <option>pending</option>
                                        <option>done</option>
                                    </select></td>
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
