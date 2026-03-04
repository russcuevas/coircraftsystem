<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics | CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @include('admin.navbar')


    <main class="main-content">
        <div class="container-fluid">
            <div class="mb-4">
                <h2 class="fw-bold">Reports & Analytics</h2>
                <p class="text-muted">Detailed breakdown of your store's performance.</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card stat-card p-4 border-0 shadow-sm"
                        style="border-left: 5px solid #198754 !important;">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success me-3"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <small class="text-muted fw-bold text-uppercase">Total Sales (Today)</small>
                                <h2 class="fw-bold mb-0">₱4,250.00</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card stat-card p-4 border-0 shadow-sm"
                        style="border-left: 5px solid #0d6efd !important;">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary me-3"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <small class="text-muted fw-bold text-uppercase">Total Sales (March 2026)</small>
                                <h2 class="fw-bold mb-0">₱124,800.00</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-8">
                    <div class="card stat-card p-4 border-0 shadow-sm h-100">
                        <h5 class="fw-bold mb-4">Monthly Sales Trend</h5>
                        <canvas id="salesChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card stat-card p-4 border-0 shadow-sm h-100 text-center">
                        <h5 class="fw-bold mb-4">Stock Overview</h5>
                        <canvas id="inventoryChart"></canvas>
                        <div class="mt-4 small text-muted">
                            Total items across all categories
                        </div>
                    </div>
                </div>
            </div>

            <div class="card stat-card border-0 p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Inventory Report Breakdown</h5>
                    <button class="btn btn-outline-dark btn-sm" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i> Print Report
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Category</th>
                                <th>Total Products</th>
                                <th>Total Stock</th>
                                <th>Sold Count</th>
                                <th>Estimated Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Soil & Fertilizers</td>
                                <td>12</td>
                                <td>450 units</td>
                                <td>320</td>
                                <td>₱112,500.00</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Home Decor</td>
                                <td>8</td>
                                <td>120 units</td>
                                <td>85</td>
                                <td>₱21,600.00</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mats & Rugs</td>
                                <td>5</td>
                                <td>35 units</td>
                                <td>150</td>
                                <td class="text-danger">₱19,250.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL</td>
                                <td>25</td>
                                <td>605 units</td>
                                <td>555</td>
                                <td>₱153,350.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Sales Chart (Line Chart)
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Sales (₱)',
                    data: [35000, 42000, 28000, 19800],
                    borderColor: '#1a3020',
                    backgroundColor: 'rgba(212, 188, 142, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Inventory Chart (Doughnut Chart)
        const invCtx = document.getElementById('inventoryChart').getContext('2d');
        new Chart(invCtx, {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Low Stock', 'Out of Stock'],
                datasets: [{
                    data: [18, 5, 2],
                    backgroundColor: ['#198754', '#ffc107', '#dc3545'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
